<?php
use Phalcon\Mvc\Model;
class Sculpture extends Model{

	public function getSource(){
    return "sculpture"; // ชื่อ ตาราง ใน ฐานข้อมูล จริงๆ
  }
}
