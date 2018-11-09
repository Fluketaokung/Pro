<?php
use Phalcon\Mvc\Model;
class Art_objects extends Model{

  public function initialize()
  {
      $this->hasMany(
        'id_no',
        'painting',
        'art_no'
      );

      $this->hasMany(
        'id_no',
        'sculpter',
        'art_no'
      );

      $this->hasMany(
        'id_no',
        'other',
        'art_no'
      );

      $this->belongsTo(
        'artist_name',
        'artist',
        'name'
      );

          $this->belongsTo(
            'collection_name',
            'collection',
            'name'
            );


            $this->hasOne(
              'id_no',
              'borrowed',
              'id_no'
              );
    
              $this->hasOne(
                'id_no',
              'permanent_collection',
              'id_no'
                );

  }
}
