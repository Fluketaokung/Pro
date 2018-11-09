<?php
use Phalcon\Mvc\Model;
class General_admission extends Model{

  public function initialize()
  {
      $this->hasOne(
          'general_id',
          'museum_goer',
          'general_id'
      );

      $this->hasMany(
        'general_id',
        'general_view',
        'general_id'
    );

  }
}