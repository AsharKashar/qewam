<?php

namespace App\GraphQL\Mutations;

use App\Model\StartupDetail;

class UpdateStartupDetails
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        return StartupDetail::updateStartup($args);
    }
}
