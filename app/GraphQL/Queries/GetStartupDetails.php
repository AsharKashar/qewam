<?php

namespace App\GraphQL\Queries;

use App\Model\StartupDetail;

class GetStartupDetails
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        return StartupDetail::find($args['id']);
    }
}
