<?php

namespace App\GraphQL\Queries;

use App\Model\User;

class Check
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }
    public function resolve($rootValue, array $args): object
    {
        $return = User::me();
        if($return ){
            return $return;
        }
    }
}
