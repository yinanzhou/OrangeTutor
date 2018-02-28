<?php

namespace app\common\model;

use think\Model;

class Appointment extends Model
{
  protected $pk = 'appointment_id';
  protected $readonly = ['appointment_id'];
}
