<?php

namespace App\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class ExpertDetail extends Model
{
    //
    protected $fillable = [
        'name',
        'phone',
        'profession',
        'bio',
        'description',
        'rate_type',
        'rate',
        'currency',
        'profile_image_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function create($user_id, $data)
    {
        $record = new ExpertDetail();
        $record->user_id = $user_id;
        $record->phone = $data['phone'];
        $record->name = $data['name'];
        $record->save();
    }

    public static function updateExpert($data)
    {
        $user_id =  Auth::user()->id;
        $record = self::where('user_id', $user_id)->first();
        foreach($data as $key=>$value){
            $record->$key = $value;
        }
        $record->save();
        return $record;
    }
}
