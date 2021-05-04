<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hootlex\Moderation\Moderatable;

class Adopt extends Model
{
    use HasFactory;
    use Moderatable;
    
//table name
    protected $table = 'adopts';
    //primary key
    public $primaryKey ='adoption id';
    //timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class);


    }
}
