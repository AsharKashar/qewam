<?php

namespace App\Relation;

use App\Model\RoadMap;
use App\Model\User;
use Illuminate\Database\Eloquent\Model;

class UserRoadMap extends Model
{
    //

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function road_map() {
        return $this->belongsTo(RoadMap::class, 'road_map_id');
    }


}
