<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoadMap extends Model
{
    //
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'road_map_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_road_maps', 'road_map_id', 'user_id');
    }
}
