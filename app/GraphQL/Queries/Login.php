<?php

namespace App\GraphQL\Queries;
use JWTAuth;

class Login
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

            $credentials = ['email' => $args['email'], 'password' => $args['password']];


        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                // return 'Invalid Credentials';
                $arr = [
                    'message' => 'Invalid Credentials',
                    'code' => 400,
                    'data' => '',
                ];
                return $arr;
            }
            auth()->attempt($credentials);
        } catch (JWTException $e) {
            // return 'could_not_create_token';
            $arr = [
                'message' => 'could not create token',
                'code' => 400,
                'data' => '',
            ];
            return $arr;
        }

            $arr = [
                'message' => 'Logged In',
                'code' => 200,
                'data' => $token,
            ];
            return $arr;
    }
}



