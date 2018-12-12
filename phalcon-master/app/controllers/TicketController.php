<?php
use Phalcon\Mvc\View;
class TicketController extends ControllerBase{
 
    public function indexAction(){

    }

    public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	    if(!$this->session->has('memberAuthen')) // ตรวจสอบว่ามี session การเข้าระบบ หรือไม่
    		$this->response->redirect('authen');   
    } 

    public function exhibitionAction(){
        $ex=Exhibition::find();
        $this->view->data=$ex;
    }

    public function admissionAction(){
        if($this->request->isPost()){
            $id = trim($this->request->getPost('id'));
            $day = trim($this->request->getPost('day'));
            $data2=Visit_admission::find("visit_id = '$id'");
            $have = 0;
            foreach($data2 as $item){
                if($item->general_id == $day) $have = 1;
            }
            if($have == 0){
                $temp = new Visit_admission();
                $temp->visit_id = $id;
                $temp->general_id = $day;
                $temp->guide_id = Null;
                $temp->status="Waiting";
                $temp->save();
            }
            else $this->flashSession->error('You have this ticket');   
        }
    }

    public function buy_admissionAction(){
        $cn=$this->request->get('name');
        $ex=Exhibition::find("name = '$cn'");
        $this->view->data=$ex;
        if($this->request->isPost()){
            $id = trim($this->request->getPost('id'));
            $data2=Visit_exhibition::find("visit_id = '$id'");
            $have = 0;
            foreach($data2 as $item){
                if($item->exhibition_name == $cn) $have = 1;
            }
            if($have == 0){
                $temp = new Visit_exhibition();
                $temp->visit_id = $id;
                $temp->exhibition_name = $cn;
                $temp->status = "Waiting";
                $temp->save();
                $ex2=Exhibition::findfirst("name = '$cn'");
                $n = $ex2->number_of_people;
                $n = $n + 1;
                $ex2->number_of_people = $n;
                $ex2->save();
            }
            else $this->flashSession->error('You have this ticket');   
        }
    }
    
    

}
