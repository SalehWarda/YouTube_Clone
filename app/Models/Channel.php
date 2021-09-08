<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $guarded=[];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function getPhoto($val){

        return ($val !== null) ? asset('images/channel ' . $this->name . '/' . $val) : "";


    }

    public function vedios(){

        return $this->hasMany(Video::class);
    }

}
