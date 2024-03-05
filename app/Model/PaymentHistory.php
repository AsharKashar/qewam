<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
        // return $this->belongsToMany(Tournament::class);

    }
}
