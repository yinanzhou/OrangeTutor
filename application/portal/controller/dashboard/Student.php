<?php

namespace app\portal\controller\dashboard;

use app\common\model\Appointment;
use app\common\model\Membership;
use app\portal\controller\Auth;
use think\Controller;

class Student extends Controller {

  protected $beforeActionList = [
    'passUserGroupInfo'
  ];

  protected function passUserGroupInfo() {
    $this->assign('user_group_ids', Auth::getUserGroupsId());
  }

  protected function checkStudentMembership() {
    if (!Auth::isStudent()) {
      abort(403);
    }
  }

  public function enroll() {
    $this->assign('active_menu','');
    if (!Auth::isLogin()) {
      return Auth::redirectToLogin($this->request);
    }
    if (Auth::isStudent()) {
      $this->assign('message','The operation cannot be proceeded because you are already granted student access to the system.');
      return view();
    }
    if (!$this->request->isPost()) {
      $this->assign('message','By clicking "Continue", you will be granted access to student services.');
      $this->assign('showEnrollButton', true);
      return view();
    }
    $uid = Auth::getUserId();
    Membership::where('user_id', $uid)
                ->where('group_id', Auth::STUDENT_GROUP_ID)
                ->delete();
    $membership = new Membership;
    $membership->user_id = $uid;
    $membership->group_id = Auth::STUDENT_GROUP_ID;
    $membership->save();
    // Refresh the user group information passed to view.
    $this->assign('user_group_ids', Auth::getUserGroupsId());
    $this->assign('message','<div class="alert alert-success" role="alert"><h4 class="alert-heading">You got it!</h4>You are now granted student access to the system.</div>You should able to see the student service menu on the left.');
    return view();
  }

  public function refer() {
    $this->assign('active_menu','student-refer');
    $this->checkStudentMembership();
    return view();
  }

  public function appointments() {
    $this->assign('active_menu','student-appointments');
    $this->checkStudentMembership();
    $this->assign('appointments',db('appointment')
        ->alias('a')
        ->where('a.student_user_id', Auth::getUserId())
        ->join('user t', 'a.tutor_user_id = t.user_id')
        ->field('a.appointment_id as appointment_id,a.appointment_starttime as appointment_starttime,a.appointment_endtime as appointment_endtime,t.user_id as tutor_user_id,t.user_firstname as tutor_firstname,t.user_middlename as tutor_middlename,t.user_lastname as tutor_lastname,t.user_email as tutor_email')
        ->order(['a.appointment_starttime','a.appointment_endtime'])
        ->select());
    $this->assign('empty_appointment_message', '<tr><td colspan="6">You do not have any appointment.</td></tr>');
    return view();
  }

  public function payment() {
    $this->assign('active_menu','student-payment');
    $this->checkStudentMembership();
    return view();
  }

  public function redirectToPaypal() {
    $this->checkStudentMembership();
    return redirect('https://paypal.me/yinan/' . input('post.amount/f') . 'USD');
  }

  public function availabilities() {
    $this->assign('active_menu','student-availabilities');
    $this->checkStudentMembership();
    $this->assign('availabilities',db('appointment')
        ->alias('a')
        ->where('a.student_user_id', null)
        ->join('user t', 'a.tutor_user_id = t.user_id')
        ->field('a.appointment_id as appointment_id,a.appointment_starttime as appointment_starttime,a.appointment_endtime as appointment_endtime,t.user_id as tutor_user_id,t.user_firstname as tutor_firstname,t.user_middlename as tutor_middlename,t.user_lastname as tutor_lastname,t.user_email as tutor_email')
        ->order(['a.appointment_starttime','a.appointment_endtime'])
        ->select());
    $this->assign('empty_availability_message', '<tr><td colspan="6">There\'s no available tutoring sessions.</td></tr>');
    return view();
  }

  public function addAppointment() {
    $this->checkStudentMembership();
    $appointment = Appointment::find(input('post.appointment_id/d'));
    if ($appointment == null) {
      return json(['message'=>'The section requested does not exist.', 'success'=>false]);
    }
    if (!is_null($appointment->student_user_id)) {
      return json(['message'=>'The spot has been taken.', 'success'=>false]);
    }
    $appointment->student_user_id = Auth::getUserId();
    $appointment->save();
    return json(['message'=>'Transaction succeeds.', 'success'=>true]);
  }

  public function removeAppointment() {
    $this->checkStudentMembership();
    $appointment = Appointment::where('appointment_id', input('post.appointment_id/d'))->where('student_user_id', Auth::getUserId())->find();
    if ($appointment == null) {
      return json('The appointment does not exists.');
    }
    $appointment->student_user_id = null;
    $appointment->save();
    return json('The appointment is now cancelled.');
  }
}
