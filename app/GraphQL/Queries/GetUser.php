<?php

namespace App\GraphQL\Queries;

use App\Model\User;

class GetUser
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        return User::find($args['id']);
    }
}
