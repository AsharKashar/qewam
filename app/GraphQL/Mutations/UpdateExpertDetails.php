<?php

namespace App\GraphQL\Mutations;

use App\Model\ExpertDetail;

class UpdateExpertDetails
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        return ExpertDetail::updateExpert($args);
    }
}
