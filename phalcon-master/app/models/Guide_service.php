<?php
use Phalcon\Mvc\Model;
class Guide_service extends Model{

  public function initialize()
  {
    $this->hasMany(
      'guide_id',
      'guide_exhibition',
      'guide_id'
    );

    $this->hasMany(
      'guide_id',
      'visitor_admission',
      'guide_id'
    );

  }
}