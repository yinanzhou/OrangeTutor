<?php

namespace app\common\model;

use think\Model;

class User extends Model
{
  protected $pk = 'user_id';
  protected $auto = ['user_email','user_firstname','user_lastname','user_middlename'];
  protected $insert = ['user_enabled' => 1];
  protected $readonly = ['user_id'];
  protected $type = [
    'user_enabled' => 'boolean',
  ];

  public function memberships() {
    return $this->hasMany('Membership');
  }

  protected function setUserFirstNameAttr($value) {//filters out the whitespace when first name is updated
    return trim($value);
  }

  protected function setUserLastNameAttr($value) {//filters out the whitespace when last name is updated
    return trim($value);
  }

  protected function setUserMiddleNameAttr($value) {//filters out the whitespace when middle name is updated
    return trim($value);
  }

  protected function setUserEmailAttr($value) {//converts email to lowercase when updated
    return strtolower($value);
  }
}
