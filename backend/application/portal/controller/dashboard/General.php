<?php

namespace app\portal\controller\dashboard;

use app\portal\controller\Auth;
use think\Controller;

class General extends Controller {

  public function home() {
    if (!Auth::isLogin()) {
      return Auth::redirectToLogin($this->request);
    }
    return view();
  }
}
