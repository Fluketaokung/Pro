<?php
use Phalcon\Mvc\Model;
class Collection extends Model{

	public function getSource(){
    return "collection"; // ชื่อ ตาราง ใน ฐานข้อมูล จริงๆ
  }
}
