<?php
use Phalcon\Mvc\View;
class CollectionController extends ControllerBase{
 
    public function indexAction(){
        $ex=Art::find();
        $this->view->data=$ex;
    }

    public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	    if(!$this->session->has('memberAuthen')) // ตรวจสอบว่ามี session การเข้าระบบ หรือไม่
    		$this->response->redirect('authen');   
    } 

    public function ObjectAction(){
        $ex=Collection::find();
        $this->view->data=$ex;
    }

}
