<?php

namespace App\Identity\Domain\Repositories;

use App\Identity\Domain\Entities\User;
use App\Identity\Domain\ValueObjects\Email;
use App\Identity\Domain\ValueObjects\PhoneNumber;

interface UserRepositoryInterface
{
    public function phoneNumberExists(PhoneNumber $phoneNumber): bool;

    public function emailExists(Email $email): bool;

    public function register(User $user): User;
}
