<?php
use Phalcon\Mvc\Model;
class Permanent_collection extends Model{

  public function initialize()
  {
      $this->hasMany(
          'id_no',
          'art_objects',
          'id_no'
      );

  }
}
