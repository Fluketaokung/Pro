<?php
use Phalcon\Mvc\Model;
class Exhibition extends Model{

	public function getSource(){
    return "exhibition"; // ชื่อ ตาราง ใน ฐานข้อมูล จริงๆ
  }
}