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

  protected function setUserFirstNameAttr($value) {//returns the first name without the white space
    return trim($value);
  }

  protected function setUserLastNameAttr($value) {//returns the last name without the white space
    return trim($value);
  }

  protected function setUserMiddleNameAttr($value) {//returns the middle name without the white space
    return trim($value);
  }

  protected function setUserEmailAttr($value) {//returns the email in all lower case letters
    return strtolower($value);
  }
}
