<?php
use Phalcon\Mvc\Model;
class Exhibition_view extends Model{

  public function initialize()
  {
      $this->belongsTo(
          'exhibition_name',
          'exhibition',
          'name'
      );

      $this->belongsTo(
        'goer_id',
        'general_admission',
        'general_id'
    );
    
  }
}