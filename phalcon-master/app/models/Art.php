<?php
use Phalcon\Mvc\Model;
class Art extends Model{

	public function getSource(){
    return "art_objects"; // ชื่อ ตาราง ใน ฐานข้อมูล จริงๆ
  }
}
