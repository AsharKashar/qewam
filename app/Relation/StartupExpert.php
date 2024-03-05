<?php

namespace App\Relation;

use App\Model\User;
use Illuminate\Database\Eloquent\Model;

class StartupExpert extends Model
{
    //
    public function expert() {
        return $this->belongsTo(User::class, 'expert_id');
    }

    public function road_map() {
        return $this->belongsTo(User::class, 'startup_id');
    }

}
