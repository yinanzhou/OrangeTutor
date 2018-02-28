<?php

namespace app\portal\controller\dashboard;

use app\portal\controller\Auth;
use think\Controller;

class General extends Controller {

  protected $beforeActionList = [
    'passUserGroupInfo'
  ];

  protected function passUserGroupInfo() {
    $this->assign('user_group_ids', Auth::getUserGroupsId());
  }

  public function home() {
    $this->assign('active_menu','dashboard');
    if (!Auth::isLogin()) {
      return Auth::redirectToLogin($this->request);
    }
    $this->assign('education_news',[
      [
        'imgUrl' => 'https://s3.amazonaws.com/orangetutor-demo/slide-images/phone.jpeg',
        'title' => 'Mina Jung: "No phone in class"',
        'description' => 'Research shows coorelation between phone usage and grade.'
      ],
      [
        'imgUrl' => 'https://s3.amazonaws.com/orangetutor-demo/slide-images/mina.jpeg',
        'title' => 'Learning MIPS increases IQ',
        'description' => 'Research shows benefits of challenging brain by coding MIPS'
      ],
    ]);

    // Self enroll section
    $selfEnrollCards = [];
    // If there is no admin in the system, show links to add him/herself as admin
    if (!Auth::isAdminExists()) {
      $selfEnrollCards[] = [
        'title' => 'Admin',
        'description' => 'The system currently has no administrator, you can set yourself as one.<br /><b>This option will be disabled for all user once there exists an administator.</b>',
        'url' => '',
        'link' => 'Add Admin Privilege',
        'enabled' => false,
      ];
    }
    if (!Auth::isStudent()) {
      $selfEnrollCards[] = [
        'title' => 'Student',
        'description' => 'Start exploring our tutor offerings, make appointments and more.',
        'url' => '/student/enroll',
        'link' => 'Enroll',
        'enabled' => true,
      ];
    }
    if (!Auth::isParent()) {
      $selfEnrollCards[] = [
        'title' => 'Parent',
        'description' => 'View your children\'s schedule.',
        'url' => '',
        'link' => 'Enroll',
        'enabled' => false,
      ];
    }
    if (!Auth::isTutor()) {
      $selfEnrollCards[] = [
        'title' => 'Tutor',
        'description' => 'Use your knowledge power to support students from local communities.',
        'url' => '/tutor/enroll',
        'link' => 'Enroll',
        'enabled' => true,
      ];
    }
    $this->assign('selfEnrollCards', $selfEnrollCards);

    return view();
  }
}
