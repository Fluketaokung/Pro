<?php
use Phalcon\Mvc\Model;
class Visit_exhibition extends Model{

  public function initialize()
  {
    $this->belongsTo(
      'visit_id',
      'visitor',
      'visit_id'
    );

    $this->belongsTo(
      'exhibition_name',
      'exhibition',
      'name'
    );

  }
}