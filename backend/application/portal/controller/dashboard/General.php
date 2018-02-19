<?php

namespace app\portal\controller\dashboard;

use app\portal\controller\Auth;
use think\Controller;

class General extends Controller {

  public function home() {
    if (!Auth::isLogin()) {
      return Auth::redirectToLogin($this->request);
    }
    $this->assign('education_news',[
      [
        'imgUrl' => '/static/slides/phone.jpeg',
        'title' => 'Mina Jung: "No phone in class"',
        'description' => 'Research shows coorelation between phone usage and grade.'
      ],
      [
        'imgUrl' => '/static/slides/mina.jpeg',
        'title' => 'Learning MIPS increases IQ',
        'description' => 'Research shows benefits of challenging brain by coding MIPS'
      ],
    ]);
    return view();
  }
}
