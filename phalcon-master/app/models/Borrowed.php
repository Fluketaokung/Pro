<?php
use Phalcon\Mvc\Model;
class Borrowed extends Model{

  public function initialize()
  {
      $this->hasOne(
          'id_no',
          'art_objects',
          'id_no'
      );

  }
}
