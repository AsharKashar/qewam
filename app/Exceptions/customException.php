<?php

namespace App\Exceptions;

use Exception;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

class customException extends Exception implements RendersErrorsExtensions
{
    //
    protected $reason;

    public function __construct(string $message, string $reason)
    {
        parent::__construct($message);

        $this->reason = $reason;
    }

    public function isClientSafe(): bool
    {
        return false;
    }

    public function getCategory(): string
    {
        return 'middleware';
    }

    public function extensionsContent(): array
    {
        return [
            'reason' => $this->reason,
        ];
    }
}
