<?php
use Phalcon\Mvc\Model;
class Sculpture extends Model{

  public function initialize()
  {
      $this->belongsTo(
          'art_no',
          'art_objects',
          'id_no'
      );

  }
}
