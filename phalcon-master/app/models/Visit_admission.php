<?php
use Phalcon\Mvc\Model;
class Visit_admission extends Model{

  public function initialize()
  {
    $this->belongsTo(
      'guide_id',
      'guide_service',
      'guide_id'
    );

    $this->belongsTo(
      'general_id',
      'general_admission',
      'general_id'
    );

    $this->belongsTo(
      'visit_id',
      'visitor',
      'visit_id'
    );

  }
}