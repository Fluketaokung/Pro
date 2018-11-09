<?php
use Phalcon\Mvc\Model;
class Guide_service extends Model{

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
        'guide_id'
    );

  }
}