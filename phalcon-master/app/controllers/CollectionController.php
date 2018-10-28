<?php
use Phalcon\Mvc\View;
class CollectionController extends ControllerBase{
 
    public function indexAction(){
        $ex=Collection::find();
        $this->view->data=$ex;
    }

    public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	    if(!$this->session->has('memberAuthen')) // ตรวจสอบว่ามี session การเข้าระบบ หรือไม่
    		$this->response->redirect('authen');   
    } 

    public function ObjectAction(){
        $cn=$this->request->get('name');
        $ex=Art::find("collection_name = '$cn'");
        $this->view->data=$ex;
    }

    public function PictureAction(){
        $cn=$this->request->get('picture');
        $ex=Art::find("picture = '$cn'");
        $this->view->data=$ex;
    }

}
