<?php

namespace App\GraphQL\Mutations;
use JWTAuth;
use App\Model\User;

class Register
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }

    public function resolve($rootValue, array $args): string
    {
        // return "Hello, {$args['name']}!";
        $user = User::registerNewUser([
            'email' => $args['email'],
            'password' => $args['password'],
            'name' => $args['name'],
            'role' => $args['role'],
            'phone' => $args['phone'],
        ]);
        return JWTAuth::fromUser($user);
    }
}
