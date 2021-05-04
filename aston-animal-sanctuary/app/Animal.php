<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Animal extends Model
{
    use Sortable;
    public $sortable = ['id','animal','date_birth','name'];
    public $fillable = ['id','animal','date_birth','name'];
     //Table Name
     protected $table='animals';
     //Primary Key
     public $primaryKey ='id';
     //Timestamps 
     public $timestamps=true;
     public function user(){
         return $this->belongsTo('App\user');
     }
     
   
}
