<?php
use Phalcon\Mvc\Model;
class Painting extends Model{

    public function getSource(){
        return "painting"; // ชื่อ ตาราง ใน ฐานข้อมูล จริงๆ
    }
}
