<?php

namespace App\Models;

use App\Models\Timezone;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{

    public function timezone(){
        return $this->belongsTo(Timezone::class);
    }
    public function email_settings(){
        return $this->hasOne(EmailConfig::class,'settings_id','id');
    }

}
