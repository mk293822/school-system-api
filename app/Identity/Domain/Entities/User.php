<?php

namespace App\Identity\Domain\Entities;

use App\Identity\Domain\ValueObjects\Email;
use App\Identity\Domain\ValueObjects\Password;
use App\Identity\Domain\ValueObjects\PhoneNumber;

class User
{
    public function __construct(
        public string $name,
        public PhoneNumber $phone_number,
        public Email $email,
        public ?string $profile_photo_path,
        public Password $password,
    ) {}
}
