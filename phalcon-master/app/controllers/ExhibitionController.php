<?php
use Phalcon\Mvc\View;
class ExhibitionController extends ControllerBase{
 
    public function indexAction(){
        $ex=Exhibition::find();
        $this->view->data=$ex;
    }

    public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	    if(!$this->session->has('memberAuthen')) // ตรวจสอบว่ามี session การเข้าระบบ หรือไม่
    		$this->response->redirect('authen');   
    } 

    public function descriptionAction(){
        $ex=Exhibition::find();
        $this->view->data=$ex;
    }

}
