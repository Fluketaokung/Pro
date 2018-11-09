<?php
use Phalcon\Mvc\Model;
class Artist extends Model{

  public function initialize()
  {
      $this->hasMany(
          'name',
          'art_objects',
          'artist_name'
      );

  }
}
