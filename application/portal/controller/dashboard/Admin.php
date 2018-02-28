<?php

namespace app\portal\controller\dashboard;

use app\portal\controller\Auth;
use think\Controller;

class Admin extends Controller {

  protected $beforeActionList = [
    'passUserGroupInfo'
  ];

  protected function passUserGroupInfo() {
    $this->assign('user_group_ids', Auth::getUserGroupsId());
  }

  protected function checkStudentMembership() {
    if (!Auth::isAdmin()) {
      abort(403);
    }
  }
}
