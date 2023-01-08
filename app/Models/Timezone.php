<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    public function generalSettings(){
        return $this->hasOne(GeneralSetting::class);
    }
}
