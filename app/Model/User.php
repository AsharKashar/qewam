<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function payment_history()
    {
        return $this->hasMany(PaymentHistory::class, 'user_id');
    }

    public function details()
    {
        if($this->role == 'start_up'){
            return $this->hasOne(StartupDetail::class, 'user_id');
        }

        if($this->role == 'expert'){
            return $this->hasOne(ExpertDetail::class, 'user_id');
        }
    }

    public function user_road_map()
    {
        return $this->belongsToMany(RoadMap::class, 'user_road_maps', 'user_id', 'road_map_id');
    }

    public function experts()
    {
            if($this->role == 'start_up'){
                return $this->belongsToMany(RoadMap::class, 'startup_experts', 'startup_id', 'expert_id');
            }
    }

    public function startups()
    {
        if($this->role == 'expert'){
            return $this->belongsToMany(RoadMap::class, 'startup_experts', 'expert_id', 'startup_id');
        }
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function registerNewUser(array $data): self
    {
        $user = new self();
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = $data['role'];

        $user->save();

        if($data['role'] == 'start_up'){
            StartupDetail::create($user->id, $data);
        }
        else if($data['role'] == 'expert'){
            ExpertDetail::create($user->id, $data);
        }

        return $user;
    }

    public static function me()
    {
        if (!auth()->check()) {
            return 'not_logged_in';
        }
        return auth()->user();

    }

    public static function logout()
    {
        auth()->logout();

    }

    public static function forgot($email)
    {
        $credentials['email'] = $email;
        $return =Password::sendResetLink($credentials);
        if($return == Password::RESET_THROTTLED){
            $arr= [
                'message' => 'Limit Reached',
                'code' => '400',
                'data' => ''
        ];
        return $arr;
        }
        if($return == Password::INVALID_USER){
            $arr= [
                'message' => 'Invalid Email ID',
                'code' => '400',
                'data' => ''
        ];
        return $arr;
        }
        if($return == Password::RESET_LINK_SENT){
             $arr= [
                'message' => 'Reset password link sent on your email id.',
                'code' => '200',
                'data' => ''
            ];
            return $arr;
        }

        $arr= [
            'message' => 'Some error occured, please try again',
            'code' => '400',
            'data' => ''
        ];
        return $arr;
    }

    public static function reset($data)
    {
        $credentials['email'] = $data['email'];
        $credentials['token'] = $data['token'];
        $credentials['password'] = $data['password'];
        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });
        if ($reset_password_status == Password::INVALID_TOKEN) {
            $arr= [
                'message' => 'Invalid token provided',
                'code' => '400',
                'data' => ''
        ];
        return $arr;
        }
        $arr= [
            'message' => 'Password updated successfully',
            'code' => '200',
            'data' => ''
        ];
        return $arr;
    }
}
