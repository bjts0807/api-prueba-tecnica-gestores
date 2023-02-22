<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    protected $table = 'favourite';
    protected $fillable = [
        'id_usuario','ref_api'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','id_usuario','id');
    }
}
