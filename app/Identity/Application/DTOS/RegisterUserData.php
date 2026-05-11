<?php

namespace App\Identity\Application\DTOS;

use App\Identity\Domain\ValueObjects\Email;
use App\Identity\Domain\ValueObjects\Password;
use App\Identity\Domain\ValueObjects\PhoneNumber;

class RegisterUserData
{
    public function __construct(
        public string $name,
        public Email $email,
        public PhoneNumber $phone_number,
        public ?string $profile_photo_path,
        public Password $password,
    ) {}
}
