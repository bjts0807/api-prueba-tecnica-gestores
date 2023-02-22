<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrengtheningSupervisionManagers extends Model
{
    use HasFactory;
    protected $table = 'strengthening_supervision_managers';
    protected $fillable = [
        'revision_date','nac_id','role_id','start_time','final_time','development_activity_image','evidence_participation_image'
    ];

    public function nac(){
        return $this->belongsTo('App\Models\Nac','nac_id','id');
    }

    public function rol(){
        return $this->belongsTo('App\Models\Rol','role_id','id');
    }
}
