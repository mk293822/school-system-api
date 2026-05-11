<?php

namespace App\Identity\Domain\ValueObjects;

use InvalidArgumentException;

final class Email
{
    public function __construct(private string $value)
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email', 422);
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
