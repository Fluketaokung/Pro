<?php
use Phalcon\Mvc\Model;
class Exhibition extends Model{

  public function initialize()
  {
      $this->hasOne(
          'name',
          'museum_goer',
          'exhibition_id'
      );

      $this->hasMany(
        'name',
        'exhibition_view',
        'exhibition_name'
    );

  }
}
