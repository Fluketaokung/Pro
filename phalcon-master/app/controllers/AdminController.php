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

    public function aArtAction(){
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
          $type=$temp->type;
          $this->session->set('id',$temp->id_no);
          $temp->save();
          $this->response->redirect('admin/a'.$type);
          
        }
      
      }

    public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	    if(!$this->session->has('memberAuthen')) // ตรวจสอบว่ามี session การเข้าระบบ หรือไม่
    		$this->response->redirect('authen');   
    } 

    public function eArtAction(){
        if($this->request->isPost()){
          $id1=$this->session->get('id');
          $id=trim($this->request->getPost('id'));
          $ex7=Art_objects::findfirst("id_no = '$id1'");

          $photoUpdate = $ex7->picture;
          $ex7->save();
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
            $temp=new Art_objects();
            $temp->id_no=trim($this->request->getPost('id'));      
            $temp->epoch=trim($this->request->getPost('epoch'));
            $temp->origin=trim($this->request->getPost('origin'));
            $temp->description=trim($this->request->getPost('description'));
            $temp->title=trim($this->request->getPost('title'));
            $temp->type=trim($this->request->getPost('type'));
            $temp->year=trim($this->request->getPost('year'));
            $temp->artist_name=trim($this->request->getPost('artist'));
            $temp->collection_name=trim($this->request->getPost('collection'));
            $temp->picture = $photoUpdate;
              
            $temp->save();

            $ex=Borrowed::findfirst("id_no = '$id1'");
            if($ex){      
              $temp=new Borrowed();     
              $temp->id_no= trim($this->request->getPost('id'));  
              $temp->date_borrowed=$ex->date_borrowed;
              $temp->date_returned=$ex->date_returned; 
              $temp->save();     
              $ex->delete();           
            }
          
            $ex2=Other::findfirst("art_no = '$id1'");
            if($ex2){      
              $temp=new Other();     
              $temp->art_no= trim($this->request->getPost('id'));  
              $temp->style=$ex2->style;
              $temp->type=$ex2->type;   
              $temp->save();   
              $ex2->delete();           
            }

            $ex3=Painting::findfirst("art_no = '$id1'");
            if($ex3){      
              $temp=new Painting();     
              $temp->art_no= trim($this->request->getPost('id'));  
              $temp->paint_type=$ex3->paint_type;
              $temp->drawn_on=$ex3->drawn_on; 
              $temp->style=$ex3->style;   
              $temp->save();   
              $ex3->delete();           
            }
          
          $ex4=Permanent_collection::findfirst("id_no = '$id1'");
          if($ex4){      
            $temp=new Permanent_collection();     
            $temp->id_no= trim($this->request->getPost('id'));  
            $temp->cost=$ex4->cost;
            $temp->status=$ex4->status;
            $temp->date_acquired=$ex4->date_acquired;
            $temp->save();        
            $ex4->delete();           
          }

          $ex5=Sculpture::findfirst("art_no = '$id1'");
          if($ex5){      
            $temp=new Sculpture();     
            $temp->art_no= trim($this->request->getPost('id'));  
            $temp->material=$ex5->material;
            $temp->height=$ex5->height;
            $temp->weight=$ex5->weight;
            $temp->style=$ex5->style;
            $temp->save();                
          }      
        $event = Art_objects::findfirst("id_no = '$id1'");
        $event->delete();
        $this->response->redirect('index'); 
        }
    }

    public function dArtAction(){
      if($this->request->isPost()){
        $id1=$this->session->get('id');
        $id=trim($this->request->getPost('id'));
        $ex7=Art_objects::findfirst("id_no = '$id1'");

          $ex=Borrowed::findfirst("id_no = '$id1'");
          if($ex){          
            $ex->delete();           
          }
        
          $ex2=Other::findfirst("art_no = '$id1'");
          if($ex2){      
            $ex2->delete();           
          }

          $ex3=Painting::findfirst("art_no = '$id1'");
          if($ex3){      
            $ex3->delete();           
          }
        
        $ex4=Permanent_collection::findfirst("id_no = '$id1'");
        if($ex4){           
          $ex4->delete();           
        }

        $ex5=Sculpture::findfirst("art_no = '$id1'");
        if($ex5){        
          $ex5->delete();            
        }      
      $event = Art_objects::findfirst("id_no = '$id1'");
      $event->delete();
      $this->response->redirect('index'); 
      }
  }

    public function SeArtAction(){
        if($this->request->isPost()){
          $id = trim($this->request->getPost('id'));
          $have=Art_objects::findFirst("id_no = '$id'");
          if(!$have){
            $this->flashSession->error('No Art_object here!!!');
        
          }
          else{
            $this->session->set('id',$id);
            $this->response->redirect('admin/eArt');
          }      
        }
    }

    public function SdArtAction(){
      if($this->request->isPost()){
        $id = trim($this->request->getPost('id'));
        $have=Art_objects::findFirst("id_no = '$id'");
        if(!$have){
          $this->flashSession->error('No Art_object here!!!');
      
        }
        else{
          $this->session->set('id',$id);
          $this->response->redirect('admin/dArt');
        }      
      }
  }

    public function SeArtistAction(){
      if($this->request->isPost()){
        $name = trim($this->request->getPost('name'));
        $have=Artist::findFirst("name = '$name'");
        if(!$have){
          $this->flashSession->error('No artist here!!!');
      
        }
        else{
          $this->session->set('name',$name);
          $this->response->redirect('admin/eArtist');
        }      
      }
    }

    public function SdArtistAction(){
      if($this->request->isPost()){
        $name = trim($this->request->getPost('name'));
        $have=Artist::findFirst("name = '$name'");
        if(!$have){
          $this->flashSession->error('No artist here!!!');
      
        }
        else{
          $this->session->set('name',$name);
          $this->response->redirect('admin/dArtist');
        }      
      }
}

    public function SeCollectionAction(){
      if($this->request->isPost()){
        $name = trim($this->request->getPost('name'));
        $have=Collection::findFirst("name = '$name'");
        if(!$have){
          $this->flashSession->error('No collection here!!!');
        }
        else{
          $this->session->set('name',$name);
          $this->response->redirect('admin/eCollection');
        }      
      }
    }

    
    public function SdCollectionAction(){
      if($this->request->isPost()){
        $name = trim($this->request->getPost('name'));
        $have=Collection::findFirst("name = '$name'");
        if(!$have){
          $this->flashSession->error('No collection here!!!');
        }
        else{
          $this->session->set('name',$name);
          $this->response->redirect('admin/dCollection');
        }      
      }
    }

    public function SeExhibitionAction(){
      if($this->request->isPost()){
        $name = trim($this->request->getPost('name'));
        $have=Exhibition::findFirst("name = '$name'");
        if(!$have){
          $this->flashSession->error('No exhibition here!!!');
        }
        else{
          $this->session->set('name',$name);
          $this->response->redirect('admin/eExhibition');
        }      
      }
    }

    public function SdExhibitionAction(){
      if($this->request->isPost()){
        $name = trim($this->request->getPost('name'));
        $have=Exhibition::findFirst("name = '$name'");
        if(!$have){
          $this->flashSession->error('No exhibition here!!!');
        }
        else{
          $this->session->set('name',$name);
          $this->response->redirect('admin/dExhibition');
        }      
      }
    }

    public function SeGeneralAction(){
      if($this->request->isPost()){
        $id = trim($this->request->getPost('id'));
        $have=General_admission::findFirst("general_id = '$id'");
        if(!$have){
          $this->flashSession->error('No general here!!!');
        }
        else{
          $this->session->set('id',$id);
          $this->response->redirect('admin/eGeneral');
        }      
      }
    }

    public function SdGeneralAction(){
      if($this->request->isPost()){
        $id = trim($this->request->getPost('id'));
        $have=General_admission::findFirst("general_id = '$id'");
        if(!$have){
          $this->flashSession->error('No general here!!!');
        }
        else{
          $this->session->set('id',$id);
          $this->response->redirect('admin/dGeneral');
        }      
      }
    }

    public function SeGuideAction(){
      if($this->request->isPost()){
        $id = trim($this->request->getPost('id'));
        $have=Guide_service::findFirst("guide_id = '$id'");
        if(!$have){
          $this->flashSession->error('No guide here!!!');
        }
        else{
          $this->session->set('id',$id);
          $this->response->redirect('admin/eGuide');
        }      
      }
    }

    public function SdGuideAction(){
      if($this->request->isPost()){
        $id = trim($this->request->getPost('id'));
        $have=Guide_service::findFirst("guide_id = '$id'");
        if(!$have){
          $this->flashSession->error('No guide here!!!');
        }
        else{
          $this->session->set('id',$id);
          $this->response->redirect('admin/dGuide');
        }      
      }
    }

    public function editAction(){

      
    }

    public function addAction(){

      
    }

    public function deleteAction(){

      
    }

    public function borrowedAction(){
      $type=$this->session->get('type');
      $act=Art::findfirst("id_no = '$id'");
      
    }

    public function apaintingAction(){
      if($this->request->isPost()){
        $temp=new Painting();
        $temp->art_no=trim($this->request->getPost('id'));
        $temp->paint_type=trim($this->request->getPost('type'));
        $temp->drawn_on=trim($this->request->getPost('drawn'));
        $temp->style=trim($this->request->getPost('style'));
        $temp->save();
        $id = trim($this->request->getPost('id'));
        $this->session->set('id',$id);
        $this->response->redirect('admin/aOwner');        
      }
    }

    public function asculptureAction(){
      if($this->request->isPost()){
        $temp=new Sculpture();
        $temp->art_no=trim($this->request->getPost('id'));
        $temp->material=trim($this->request->getPost('material'));
        $temp->height=trim($this->request->getPost('height'));
        $temp->weight=trim($this->request->getPost('weight'));
        $temp->style=trim($this->request->getPost('style'));
        $temp->save();
        $id = trim($this->request->getPost('id'));
        $act=Sculpture::findfirst("art_no = '$id'");
        if($act){
          $this->session->set('id',$id);
          $this->response->redirect('admin/aOwner');      
        }
        else{
          $this->flashSession->error('Not Found');
        }    
      }
    }

    public function aArtistAction(){
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
        $temp=new Artist();
        $temp->name=trim($this->request->getPost('name'));
        $temp->country_of_origin=trim($this->request->getPost('country'));
        $temp->epoch=trim($this->request->getPost('epoch'));
        $temp->main_style=trim($this->request->getPost('style'));
        $temp->date_born=trim($this->request->getPost('born'));
        $temp->date_died=trim($this->request->getPost('died'));
        $temp->description=trim($this->request->getPost('description'));
        $temp->picture=$photoUpdate;
        $temp->save();
        $name = trim($this->request->getPost('name'));
        $act=Artist::findfirst("name = '$name'");
        if($act){
          $this->response->redirect('index');      
        }
        else{
          $this->flashSession->error('Not Found');
        }    
      }
    }

    public function eArtistAction(){
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
        $name=$this->session->get('name');
        $temp=Artist::findfirst("name = '$name'");;
        $temp->name=trim($this->request->getPost('name'));
        $temp->country_of_origin=trim($this->request->getPost('country'));
        $temp->epoch=trim($this->request->getPost('epoch'));
        $temp->main_style=trim($this->request->getPost('style'));
        $temp->date_born=trim($this->request->getPost('born'));
        $temp->date_died=trim($this->request->getPost('died'));
        $temp->description=trim($this->request->getPost('description'));
        if($isUploaded) $temp->picture=$photoUpdate;
        $temp->save();
        $name = trim($this->request->getPost('name'));
        $act=Artist::findfirst("name = '$name'");
        if($act){
          $this->response->redirect('index');      
        }
        else{
          $this->flashSession->error('Not Found');
        }    
      }
    }

    public function dArtistAction(){
      if($this->request->isPost()){
        $name=$this->session->get('name');
        $act=Artist::findfirst("name = '$name'");
        $ex=Art_objects::find("artist_name = '$act->name'");
        foreach($ex as $item){
          $item->artist_name = Null;
          $item->save();
        }
        $act->delete();
        $this->response->redirect('index');        
      }
    }


    public function aotherAction(){
      if($this->request->isPost()){
        $temp=new Other();
        $temp->art_no=trim($this->request->getPost('id'));
        $temp->style=trim($this->request->getPost('style'));
        $temp->type=trim($this->request->getPost('type'));
        $temp->save();
        $id = trim($this->request->getPost('id'));
        $this->session->set('id',$id);
        $this->response->redirect('admin/aOwner');   
        $id = trim($this->request->getPost('id'));
        $act=Other::findfirst("art_no = '$id'");
        if($act){
          $this->session->set('id',$id);
          $this->response->redirect('admin/aOwner');      
        }
        else{
          $this->flashSession->error('Not Found');
        }      
      }
      
    }

    public function aOwnerAction(){
          
    }

    public function aBorrowedAction(){
      if($this->request->isPost()){
        $id = trim($this->request->getPost('id'));
        $temp=new Borrowed();
        $temp->id_no=trim($this->request->getPost('id'));
        $temp->date_borrowed=trim($this->request->getPost('start'));
        $temp->date_returned=trim($this->request->getPost('end'));
        $temp->save();
        $act=Borrowed::findfirst("id_no = '$id'");
        if($act){
          $this->response->redirect('index');   
        }
        else{
          $this->flashSession->error('Not Found');
        } 
      }
          
    }

    public function aMuseumAction(){
      if($this->request->isPost()){
        $id = trim($this->request->getPost('id'));
        $temp=new Museum();
        $temp->id_no=trim($this->request->getPost('id'));
        $temp->cost=trim($this->request->getPost('cost'));
        $temp->status=trim($this->request->getPost('status'));
        $temp->date_acquired=trim($this->request->getPost('get'));
        $temp->save();
        $act=Museum::findfirst("id_no = '$id'");
        if($act){
          $this->response->redirect('index');   
        }
        else{
          $this->flashSession->error('Not Found');
        } 
      }
          
    }

    public function aCollectionAction(){
      if($this->request->isPost()){
        $temp=new Collection();
        $temp->name=trim($this->request->getPost('name'));
        $temp->phone=trim($this->request->getPost('phone'));
        $temp->address=trim($this->request->getPost('address'));
        $temp->description=trim($this->request->getPost('description'));
        $temp->type=trim($this->request->getPost('type'));
        $temp->contact_person=trim($this->request->getPost('person'));
        $temp->save();
        $name=trim($this->request->getPost('name'));
        $act=Collection::findfirst("name = '$name'");
        if($act){
          $this->response->redirect('index');   
        }
        else{
          $this->flashSession->error('Not Found');
        } 
      }
          
    }

    public function eCollectionAction(){
      if($this->request->isPost()){
        $name=$this->session->get('name');
        $temp2=new Collection();
        $temp2->name=trim($this->request->getPost('name'));
        $temp2->phone=trim($this->request->getPost('phone'));
        $temp2->address=trim($this->request->getPost('address'));
        $temp2->description=trim($this->request->getPost('description'));
        $temp2->type=trim($this->request->getPost('type'));
        $temp2->contact_person=trim($this->request->getPost('person'));
        $temp2->save();
        $ex=Art::find("collection_name = '$name'");
        foreach($ex as $item){
          $item->collection_name = trim($this->request->getPost('name'));
          $item->save();
        }
        $event = Collection::findfirst("name = '$name'");
        $event->delete();
        $this->response->redirect('index'); 
      }
          
    }

    public function dCollectionAction(){
      if($this->request->isPost()){
        $name=$this->session->get('name');
        $temp= Collection::findfirst("name = '$name'");
        $ex=Art::find("collection_name = '$temp->name'");
          foreach($ex as $item){
            $item->collection_name = Null;
            $item->save();
          }
        $temp->delete();
        $this->response->redirect('index'); 
      }
          
    }

    public function aExhibitionAction(){
      if($this->request->isPost()){
        $temp=new Exhibition();
        $temp->name=trim($this->request->getPost('name'));
        $temp->start_date=trim($this->request->getPost('start'));
        $temp->end_date=trim($this->request->getPost('end'));
        $temp->number_of_people=trim($this->request->getPost('number'));
        $temp->save();
        $name=trim($this->request->getPost('name'));
        $act=Exhibition::findfirst("name = '$name'");
        if($act){
          $this->response->redirect('index');   
        }
        else{
          $this->flashSession->error('Not Found');
        } 
      }
          
    }

    public function dExhibitionAction(){
      if($this->request->isPost()){
        $name=trim($this->request->getPost('name'));
        $act=Exhibition::findfirst("name = '$name'");
        $act->delete();
        $this->response->redirect('index');   
        
      }
          
    }

    public function eExhibitionAction(){
      if($this->request->isPost()){
        $temp=new Exhibition();
        $temp->name=trim($this->request->getPost('name'));
        $temp->start_date=trim($this->request->getPost('start'));
        $temp->end_date=trim($this->request->getPost('end'));
        $temp->number_of_people=trim($this->request->getPost('number'));
        $temp->save();
        $name=trim($this->request->getPost('name'));
        $act=Exhibition::findfirst("name = '$name'");
        if($act){
          $this->response->redirect('index');   
        }
        else{
          $this->flashSession->error('Not Found');
        } 
      }
          
    }

    public function aGeneralAction(){
      if($this->request->isPost()){
        $temp=new General_admission();
        $temp->general_id=trim($this->request->getPost('id'));
        $temp->save();
        $id=trim($this->request->getPost('id'));
        $act=General_admission::findfirst("general_id = '$id'");
        if($act){
          $this->response->redirect('index');   
        }
        else{
          $this->flashSession->error('Not Found');
        } 
      }
          
    }

    public function dGeneralAction(){
      if($this->request->isPost()){
        $id=trim($this->request->getPost('id'));
        $act=General_admission::findfirst("general_id = '$id'");
        $act->delete();
        $this->response->redirect('index');    
      }         
    }

    public function eGeneralAction(){
      if($this->request->isPost()){
        $temp=new GeneGeneral_admissionral();
        $temp->general_id=trim($this->request->getPost('id'));
        $temp->save();
        $id=$this->session->get('id');
        $act=General_admission::findfirst("general_id = '$id'");
        $act->delete();
        if(!$act){
          $this->response->redirect('index');   
        }
        else{
          $this->flashSession->error('Not Found');
        } 
      }
          
    }

    public function aGuideAction(){
      if($this->request->isPost()){
        $temp=new Guide_service();
        $temp->guide_id=trim($this->request->getPost('id'));
        $temp->name=trim($this->request->getPost('name'));
        $temp->rating=trim($this->request->getPost('rating'));
        $temp->time=trim($this->request->getPost('time'));
        $temp->save();
        $id=trim($this->request->getPost('id'));
        $act=Guide_service::findfirst("guide_id = '$id'");
        if($act){
          $this->response->redirect('index');   
        }
        else{
          $this->flashSession->error('Not Found');
        } 
      }
          
    }

    public function eGuideAction(){
      if($this->request->isPost()){
        $temp=new Guide_service();
        $temp->guide_id=trim($this->request->getPost('id'));
        $temp->name=trim($this->request->getPost('name'));
        $temp->rating=trim($this->request->getPost('rating'));
        $temp->time=trim($this->request->getPost('time'));
        $temp->save();
        $id=$this->session->get('id');
        $act=Guide_service::findfirst("guide_id = '$id'");
        $act->delete();
        if(!$act){
          $this->response->redirect('index');   
        }
        else{
          $this->flashSession->error('Not Found');
        } 
      }
          
    }

    public function dGuideAction(){
      if($this->request->isPost()){
        $id=trim($this->request->getPost('id'));
        $act=Guide_service::findfirst("guide_id = '$id'");
        $act->delete();
        $this->response->redirect('index');    
      }         
    }
}
