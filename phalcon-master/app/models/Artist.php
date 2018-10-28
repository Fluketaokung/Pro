<?php
use Phalcon\Mvc\Model;
class Artist extends Model{

	public function getSource(){
    return "artist"; // ชื่อ ตาราง ใน ฐานข้อมูล จริงๆ
  }
}
