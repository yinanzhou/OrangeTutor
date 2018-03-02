<?php

namespace app\common\model;

use think\Model;

class Membership extends Model
{
  protected $pk = 'user_id,group_id';
  protected $type = [
    'membership_validfrom' => 'datetime',//forces datatype to be a datetime 
    'membership_expiration' => 'datetime',//forces datatype to be a datetime
  ];

  public function user() {
    return $this->belongsTo('user','user_id','user_id');//connects $this to the user groups
  }

  public function group() {
    return $this->belongsTo('group','group_id','group_id');//connects $this to the different groups
  }
}
