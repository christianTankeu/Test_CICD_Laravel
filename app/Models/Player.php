<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = ['id'];
    public $timestamps = null;
    protected $dates = ['created_at'];

    public function cashgames(){
        return $this->belongsToMany('App\Models\Cashgame', 'cashgamers')
                                ->withPivot(['state','party_id']);
    }

    public function siteandgos(){
        return $this->belongsToMany('App\Models\Siteandgo', 'saggamers')
                                ->withPivot(['bet','coins','state','party_id']);
    }

    public function transactions(){
        return $this->hasMany('App\Models\Transaction');
    }

    public function user(){
        return $this->belongsTo('App\Models\Player');
    }

    public function account(){
        return $this->hasOne('App\Models\Account');
    }

}
