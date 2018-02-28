<?php

namespace app\portal\controller\dashboard;

use app\common\model\Membership;
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
}
