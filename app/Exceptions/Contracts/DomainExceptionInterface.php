<?php

namespace App\Exceptions\Contracts;

interface DomainExceptionInterface
{
    public function getMessage(): string;

    public function statusCode(): int;

    public function errorCode(): string;
}
