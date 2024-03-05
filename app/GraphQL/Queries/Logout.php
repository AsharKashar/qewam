<?php

namespace App\GraphQL\Queries;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class Logout
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }

    public function resolve($rootValue, array $args): array
    {
        // User::logout();
        JWTAuth::invalidate(JWTAuth::getToken());
        // IF(auth()->logout()){
            $arr= [
                    'message' => 'Logged out Successfully.',
                    'code' => '200',
                    'data' => ''
            ];
        // }
        return $arr;
    }
}
