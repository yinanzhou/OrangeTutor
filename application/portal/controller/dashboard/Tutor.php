<?php

namespace app\portal\controller\dashboard;

use app\common\model\Appointment;
use app\common\model\Membership;
use app\common\model\TutorSubject;
use app\common\model\TutorSubjectMastery;
use app\common\model\User;
use app\portal\controller\Auth;
use think\Controller;

class Tutor extends Controller {

  protected $beforeActionList = [
    'passUserGroupInfo'
  ];

  protected function passUserGroupInfo() {
    $this->assign('user_group_ids', Auth::getUserGroupsId());
  }

  protected function checkTutorMembership() {
    if (!Auth::isTutor()) {
      abort(403);
    }
  }

  public function enroll() {
    $this->assign('active_menu','');
    if (!Auth::isLogin()) {
      return Auth::redirectToLogin($this->request);
    }
    if (Auth::isTutor()) {
      $this->assign('message','The operation cannot be proceeded because you are already granted tutor access to the system.');
      return view();
    }
    if (!$this->request->isPost()) {
      $this->assign('message','By clicking "Continue", you will be granted access to tutor services.');
      $this->assign('showEnrollButton', true);
      return view();
    }
    $uid = Auth::getUserId();
    Membership::where('user_id', $uid)
                ->where('group_id', Auth::TUTOR_GROUP_ID)
                ->delete();
    $membership = new Membership;
    $membership->user_id = $uid;
    $membership->group_id = Auth::TUTOR_GROUP_ID;
    $membership->save();
    // Refresh the user group information passed to view.
    $this->assign('user_group_ids', Auth::getUserGroupsId());
    $this->assign('message','<div class="alert alert-success" role="alert"><h4 class="alert-heading">You got it!</h4>You are now granted tutor access to the system.</div>You should able to see the tutor service menu on the left.');
    return view();
  }

  public function appointments() {
    $this->assign('active_menu','tutor-appointments');
    $this->checkTutorMembership();
    $this->assign('appointments',db('appointment')
        ->alias('a')
        ->where('a.tutor_user_id', Auth::getUserId())
        ->whereNotNull('a.student_user_id')
        ->join('user s', 'a.student_user_id = s.user_id')
        ->field('a.appointment_id as appointment_id,a.appointment_starttime as appointment_starttime,a.appointment_endtime as appointment_endtime,s.user_firstname as student_firstname,s.user_middlename as student_middlename,s.user_lastname as student_lastname,s.user_email as student_email')
        ->order(['a.appointment_starttime','a.appointment_endtime'])
        ->select());
    $this->assign('empty_appointment_message', '<tr><td colspan="6">You do not have any appointment.</td></tr>');
    return view();
  }

  public function subjects() {
    $uid = Auth::getUserId();
    $this->assign('active_menu','tutor-subjects');
    $this->checkTutorMembership();
    $this->assign('subjects',db('tutor_subject')
        ->field('tutor_subject_code as code,tutor_subject_name as name')
        ->order('tutor_subject_code')
        ->select());
    $this->assign('masteries', TutorSubjectMastery::where('user_id', $uid)->column('tutor_subject_code'));
    return view();
  }

  public function addSubject($subject_code) {
    $this->checkTutorMembership();
    $uid = Auth::getUserId();
    TutorSubjectMastery::where('user_id', $uid)
                ->where('tutor_subject_code', $subject_code)
                ->delete();
    $t = new TutorSubjectMastery;
    $t->user_id = $uid;
    $t->tutor_subject_code = $subject_code;
    if(TutorSubject::find($subject_code) == null) {
      return json('Transaction failed.', 200);
    }
    $t->save();
    return json('Transaction succeeds.', 200);
  }

  public function removeSubject($subject_code) {
    $this->checkTutorMembership();
    $uid = Auth::getUserId();
    TutorSubjectMastery::where('user_id', $uid)
                ->where('tutor_subject_code', $subject_code)
                ->delete();
    return json('Transaction succeeds.', 200);
  }

  public function profile($user_id) {
    if (!Auth::isLogin()) {
      return Auth::redirectToLogin($this->request);
    }
    $tutor = User::find($user_id);
    if ($tutor == null) {
      abort(404);
    }
    if (!Auth::isTutor($tutor->user_id)) {
      abort(404);
    }
    $this->assign('t', $tutor);
    $uid = Auth::getUserId();
    $this->assign('active_menu','tutor-subjects');
    $this->checkTutorMembership();
    $this->assign('subjects',db('tutor_subject_mastery')
        ->alias('sm')
        ->where('sm.user_id', $tutor->user_id)
        ->join('tutor_subject ts','sm.tutor_subject_code=ts.tutor_subject_code','LEFT')
        ->field('ts.tutor_subject_code as code,ts.tutor_subject_name as name')
        ->order('ts.tutor_subject_code')
        ->select());
    return view();
  }

  public function availabilities() {
    $this->assign('active_menu','tutor-availabilities');
    $uid = Auth::getUserId();
    $this->checkTutorMembership();
    if($this->request->isPost()) {
      $starttime = strtotime(input('post.starttime'));
      $endtime = strtotime(input('post.endtime'));
      $error_message = "";
      if($starttime == false) {
        $error_message .= "Cannot parse the start time. ";
      }
      if($endtime == false) {
        $error_message .= "Cannot parse the end time. ";
      }
      if(empty($error_message)) {
        $appointment = new Appointment;
        $appointment->tutor_user_id = $uid;
        $appointment->appointment_starttime = date('Y-m-d H:i:s', $starttime);
        $appointment->appointment_endtime = date('Y-m-d H:i:s', $endtime);
        $appointment->save();
        $this->assign('alert','Transaction succeeds.');
      } else {
        $this->assign('alert',$error_message);
      }
    }
    $this->assign('availabilities',db('appointment')
        ->alias('a')
        ->where('a.tutor_user_id', $uid)
        ->whereNull('a.student_user_id')
        ->field('a.appointment_id as appointment_id,a.appointment_starttime as appointment_starttime,a.appointment_endtime as appointment_endtime')
        ->order(['a.appointment_starttime','a.appointment_endtime'])
        ->select());
    $this->assign('empty_availability_message', '<tr><td colspan="6">You do not have any availability.</td></tr>');
    return view();
  }
}
