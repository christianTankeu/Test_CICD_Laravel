<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siteandgo extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = ['id'];
    public $timestamps = null;
    protected $dates = ['created_at'];

    public function game(){
        return $this->belongsTo('App\Models\Game');
    }
    
    public function players(){
        return $this->belongsToMany('App\Models\Player', 'saggamers')
                                    ->withPivot(['bet','coins','state']);
    }

    public function parties(){
        return $this->belongsToMany('App\Models\Party', 'saggamers');
    }
}
