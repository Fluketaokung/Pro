<?php
use Phalcon\Mvc\Model;
class Borrowed extends Model{

	public function getSource(){
    return "borrowed"; // ชื่อ ตาราง ใน ฐานข้อมูล จริงๆ
  }
}
