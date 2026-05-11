<?php

namespace App\Identity\Domain\ValueObjects;

use InvalidArgumentException;

class PhoneNumber
{
    public function __construct(
        private readonly string $value
    ) {
        if (! preg_match('/^\+?[0-9]{7,15}$/', $value)) {
            throw new InvalidArgumentException('Invalid phone number.');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
