<?php
use Phalcon\Mvc\Model;
class Visitor extends Model{

  public function initialize()
  {
    $this->hasMany(
      'visit_id',
      'visit_admission',
      'visit_id'
    );

    $this->hasMany(
      'visit_id',
      'visit_exhibition',
      'visit_id'
    );

  }
}