<?php
use Phalcon\Mvc\Model;
class Admin extends Model{

  public function initialize()
  {
      $this->hasOne(
          'username',
          'user',
          'username'
      );
  }


}
