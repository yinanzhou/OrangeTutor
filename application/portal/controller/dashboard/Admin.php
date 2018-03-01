<?php

namespace app\portal\controller\dashboard;

use app\common\model\User;
use app\portal\controller\Auth;
use think\Controller;

class Admin extends Controller {

  protected $beforeActionList = [
    'passUserGroupInfo'
  ];

  protected function passUserGroupInfo() {
    $this->assign('user_group_ids', Auth::getUserGroupsId());
  }

  protected function checkAdminMembership() {
    if (!Auth::isAdmin()) {
      abort(403);
    }
  }

  public function users() {
    $this->assign('active_menu','admin-users');
    $this->checkAdminMembership();
    $this->assign('users', User::select());
    return view();
  }
}
