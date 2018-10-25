<?php
use Phalcon\Mvc\View;
class AddController extends ControllerBase{
 
  public function indexAction(){
    if($this->request->isPost()){
      $photoUpdate='';
      if($this->request->hasFiles() != true){
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
      $temp=new Event();
      $temp->name=trim($this->request->getPost('name'));
      $temp->date=trim($this->request->getPost('day'));
      $temp->detail=trim($this->request->getPost('detail'));
      $temp->picture=$photoUpdate;
      $temp->save();
      $this->response->redirect('event');
    }
  
  }

}
