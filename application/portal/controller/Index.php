
<?php

namespace app\portal\controller;

use think\Controller;

// This enables an extension from the controller to the Index which for the specific user, Tutor, to view the availability.
class Index extends Controller {
  public function index() {
    return view();
  }
}
