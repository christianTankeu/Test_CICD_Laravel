<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cashgame extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = ['id'];
    public $timestamps = null;
    protected $dates = ['created_at'];

    public function fapfap(){
        return $this->belongsTo('App\Models\Fapfap');
    }

    public function players(){
        return $this->belongsToMany('App\Models\Player', 'cashgamers')
                                ->withPivot(['state', 'party_id']);
    }

    public function parties(){
        return $this->belongsToMany('App\Models\Party', 'cashgamers')
                                ->withPivot('state', 'player_id');
    }

    
}
