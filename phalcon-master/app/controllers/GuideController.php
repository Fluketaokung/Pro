<?php
use Phalcon\Mvc\View;
class GuideController extends ControllerBase{
 
    public function indexAction(){
        $ex=Guide_service::find();
        $this->view->data=$ex;
    }

    public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	    if(!$this->session->has('memberAuthen')) // ตรวจสอบว่ามี session การเข้าระบบ หรือไม่
    		$this->response->redirect('authen');   
    } 

    public function hireAction(){
        $cn=$this->request->get('id');
        $ex=Guide_service::find("guide_id = '$cn'");
        $this->view->data=$ex;
        if($this->request->isPost()){
            $id = trim($this->request->getPost('vid'));
            $day = trim($this->request->getPost('gid'));
            $data2=Visit_admission::find("visit_id = '$id'");
            $have = 0;
            foreach($data2 as $item){
                if($item->general_id == $day){
                    $have = 1;
                    if($item->guide_id == Null){
                        $item->guide_id = $cn;
                        $item->save();
                    }
                    else $this->flashSession->error('You have guide this day, Can not hire this guide.');  
                } 
            }
            if($have == 0){
                $this->flashSession->error('You do not have this ticket');
            }  
        }
    }

}
