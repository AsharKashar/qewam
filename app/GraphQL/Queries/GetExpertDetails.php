<?php

namespace App\GraphQL\Queries;

use App\Model\ExpertDetail;

class GetExpertDetails
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        return ExpertDetail::find($args['id']);
    }
}
