<?php

namespace App\Identity\Domain\ValueObjects;

use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class Password
{
    private string $hashed;

    /**
     * Create from plain password (will be validated + hashed)
     */
    public function __construct(string $plainPassword, bool $alreadyHashed = false)
    {
        if (! $alreadyHashed) {
            $this->validate($plainPassword);
            $this->hashed = Hash::make($plainPassword);
        } else {
            $this->hashed = $plainPassword;
        }
    }

    /**
     * Factory for creating from stored hash
     */
    public static function fromHash(string $hash): self
    {
        return new self($hash, true);
    }

    /**
     * Validate password rules (domain rules, not controller rules)
     */
    private function validate(string $password): void
    {
        if (strlen($password) < 8) {
            throw new InvalidArgumentException('Password must be at least 8 characters.');
        }

        if (! preg_match('/[A-Z]/', $password)) {
            throw new InvalidArgumentException('Password must contain at least one uppercase letter.');
        }

        if (! preg_match('/[0-9]/', $password)) {
            throw new InvalidArgumentException('Password must contain at least one number.');
        }
    }

    /**
     * Check plain password against stored hash
     */
    public function matches(string $plainPassword): bool
    {
        return Hash::check($plainPassword, $this->hashed);
    }

    /**
     * Get hashed value (for persistence)
     */
    public function value(): string
    {
        return $this->hashed;
    }

    /**
     * For storing in DB
     */
    public function __toString(): string
    {
        return $this->hashed;
    }
}
