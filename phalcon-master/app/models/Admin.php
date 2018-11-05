<?php
use Phalcon\Mvc\Model;
class Admin extends Model{

	public function getSource(){
    return "admin"; // ชื่อ ตาราง ใน ฐานข้อมูล จริงๆ
  }
}
