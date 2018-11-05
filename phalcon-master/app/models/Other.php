<?php
use Phalcon\Mvc\Model;
class Other extends Model{

	public function getSource(){
    return "other"; // ชื่อ ตาราง ใน ฐานข้อมูล จริงๆ
  }
}
