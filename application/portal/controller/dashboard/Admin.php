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

  public function setUserStatus() {
    $this->checkAdminMembership();
    $user = User::find(input('post.user_id/d'));
    if ($user === null) {
      return json('There is no user associated with the specified user id.', 400);
    }
    $user->user_enabled = input('post.user_enabled/b')?1:0;
    $user->save();
    if ($user->user_enabled == 0) {
      Auth::resetUserLoginToken($user->user_id);
    }
    return json('Transaction succeeds.', 200);
  }
}
