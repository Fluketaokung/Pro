<?php
use Phalcon\Mvc\Model;
class Guide_service extends Model{

  public function initialize()
  {
      $this->hasMany(
          'guide_id',
          'exhibition_view',
          'guide_id'
      );

      $this->hasMany(
        'guide_id',
        'general_view',
        'guide_id'
    );

  }
}