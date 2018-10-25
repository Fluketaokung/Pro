<?php
use Phalcon\Mvc\View;
class EventController extends ControllerBase{
 
 public function indexAction(){

  }

  public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	  if(!$this->session->has('memberAuthen')) // ตรวจสอบว่ามี session การเข้าระบบ หรือไม่
    		 $this->response->redirect('authen');   
   } 


  public function deleteIdAction($event){
    $event = Event::findFirst($event);
    $event->delete();
    $this->response->redirect('event');    
  }

  public function setIdAction($event){
    $this->session->set('id',$event);
	  $this->response->redirect('event/edit');    
  }
 public function editAction(){
    if($this->request->isPost()){
      $name = trim($this->request->getPost('name')); // รับค่าจาก form
      $date = trim($this->request->getPost('day')); // รับค่าจาก form
      $detail = trim($this->request->getPost('detail')); // รับค่าจาก form
      $photoUpdate = trim($this->request->getPost('customFile')); 
      //$photoUpdate=$picture;
      if($this->request->hasFiles() == true){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $uploads = $this->request->getUploadedFiles();
        $isUploaded = false;			
        foreach($uploads as $upload){
          if(in_array($upload->gettype(), $allowed)){					
            $photoName=md5(uniqid(rand(), true)).strtolower($upload->getname());
            $path = '../public/img/database/'.$photoName;
            ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
          }
        }
        if($isUploaded)  $photoUpdate=$photoName ;
      }
      
      $id=$this->session->get('id');
      $event=Event::findFirst("id = '$id'");
      $event->name=$name;
      $event->date=$date;
      $event->detail=$detail;
      $event->picture=$photoUpdate;
      $event->save();
      $this->response->redirect('event');
      }
  }


}
