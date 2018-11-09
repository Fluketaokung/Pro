<?php
use Phalcon\Mvc\Model;
class Museum_goer extends Model{

  public function initialize()
  {
      $this->belongsTo(
          'exhibition_name',
          'exhibition',
          'name'
      );

      $this->belongsTo(
        'guide_id',
        'guide_service',
        'guide_id'
    );

  }
}