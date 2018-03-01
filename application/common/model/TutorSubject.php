<?php

namespace app\common\model;

use think\Model;

class TutorSubject extends Model
{
  protected $pk = 'tutor_subject_code';
  protected $readonly = ['tutor_subject_code', 'tutor_subject_name'];
}
