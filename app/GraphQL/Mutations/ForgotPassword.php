<?php

namespace App\GraphQL\Mutations;

use App\Model\User;

class ForgotPassword
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        return User::forgot($args['email']);
    }
}
