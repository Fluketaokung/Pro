<?php
use Phalcon\Mvc\View;
class AdminController extends ControllerBase{
 
    public function indexAction(){
        $cn = $this->session->get('memberEmail');
        $ex=Admin::findfirst("username = '$cn'");
        if($cn != $ex->username){
            $this->response->redirect('index');
        }
        $this->view->data=$ex;
    }

    public function addAction(){
        if($this->request->isPost()){
          $photoUpdate='';
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
            if($isUploaded)  $photoUpdate=$photoName;
            
          }
          $temp=new Art();
          $temp->id_no=trim($this->request->getPost('id'));
          $temp->epoch=trim($this->request->getPost('epoch'));
          $temp->origin=trim($this->request->getPost('origin'));
          $temp->description=trim($this->request->getPost('description'));
          $temp->title=trim($this->request->getPost('title'));
          $temp->type=trim($this->request->getPost('type'));
          $temp->year=trim($this->request->getPost('year'));
          $temp->artist_name=trim($this->request->getPost('artist'));
          $temp->collection_name=trim($this->request->getPost('collcection'));
          $temp->picture=$photoUpdate;
          $temp->save();
          $this->response->redirect('index');
          
        }
      
      }

    public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	    if(!$this->session->has('memberAuthen')) // ตรวจสอบว่ามี session การเข้าระบบ หรือไม่
    		$this->response->redirect('authen');   
    } 

    public function editAction(){
        if($this->request->isPost()){
          $id = trim($this->request->getPost('id')); // รับค่าจาก form
          $title = trim($this->request->getPost('title')); // รับค่าจาก form
          $artist = trim($this->request->getPost('artist')); // รับค่าจาก form
          $year = trim($this->request->getPost('year'));
          $description = trim($this->request->getPost('description')); // รับค่าจาก form
          $type = trim($this->request->getPost('type')); // รับค่าจาก form
          $epoch = trim($this->request->getPost('epoch')); // รับค่าจาก form
          $origin = trim($this->request->getPost('origin')); // รับค่าจาก form 
          $collection = trim($this->request->getPost('collection')); // รับค่าจาก form
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
          $art=Art::findFirst("id_no = '$id'");
          $art->id_no=$id;
          $art->title=$title;
          $art->artist_name=$artist;
          $art->origin=$origin;
          $art->year=$year;
          $art->type=$type;
          $art->epoch=$epoch;
          $art->origin=$origin;
          $art->collection_name=$collection;
          if($isUploaded) $art->picture=$photoUpdate;
          $art->save();
          $this->response->redirect('admin');
        }
    }

    public function pickeditAction(){
        if($this->request->isPost()){
            $id = trim($this->request->getPost('id'));
            $this->session->set('id',$id);
            $this->response->redirect('admin/edit');
        }
    }

}
