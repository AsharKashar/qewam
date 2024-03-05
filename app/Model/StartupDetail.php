<?php

namespace App\Model;

use App\Model\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class StartupDetail extends Model
{
    //
    protected $fillable = [
        'company_name',
        'company_website',
        'comapny_details',
        'stage',
        'city',
        'state',
        'country',
        'team_size',
        'monthly_revenue',
        'founded_year',
        'funds_raised',
        'industry',
        'profile_image_url',
        'tags',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function create($user_id, $data)
    {
        $record = new StartupDetail();
        $record->user_id = $user_id;
        $record->phone = $data['phone'];
        $record->company_name = $data['name'];
        $record->save();
    }

    public static function updateStartup($data)
    {
        $user_id = Auth::user()->id;
        $record = self::where('user_id',$user_id)->first();
        foreach($data as $key=>$value){
            $record->$key = $value;
        }
        $record->save();
        return $record;
    }
}
