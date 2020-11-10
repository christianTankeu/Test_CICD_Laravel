<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fapfap extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = ['id'];
    public $timestamps = null;
    protected $table = 'fapfap';
    protected $dates = ['created_at'];

    public function game(){
        return $this->belongsTo('App\Model\Game');
    }

    public function cashgames(){
        return $this->hasMany('App\Models\Cashgame');
    }

    public function siteandgos(){
        return $this->hasMany('App\Models\Siteandgo');
    }

    
}
