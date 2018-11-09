<?php
use Phalcon\Mvc\Model;
class Collection extends Model{

  public function initialize()
  {
      $this->hasMany(
          'name',
          'art_objects',
          'collection_name'
      );

  }
}
