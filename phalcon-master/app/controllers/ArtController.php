<?php
use Phalcon\Mvc\View;
class ArtController extends ControllerBase{
 
    public function indexAction(){
        
    }

    public function typeAction(){
        $cn=$this->request->get('name');
        $ex=$cn::find();
        $this->view->data=$ex;
    }

    public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	    if(!$this->session->has('memberAuthen')) // ตรวจสอบว่ามี session การเข้าระบบ หรือไม่
    		$this->response->redirect('authen');   
    } 

    public function pictureAction(){
        $cn=$this->request->get('picture');
        $ex=Art_objects::find("picture = '$cn'");
        $this->view->data=$ex;
    }

}
