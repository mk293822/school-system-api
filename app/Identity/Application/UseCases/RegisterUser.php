<?php

namespace App\Identity\Application\UseCases;

use App\Identity\Application\DTOS\RegisterUserData;
use App\Identity\Domain\Entities\User;
use App\Identity\Domain\Repositories\UserRepositoryInterface;

class RegisterUser
{
    public function __construct(
        private UserRepositoryInterface $repo,
    ) {}

    public function execute(RegisterUserData $data): User
    {
        if ($this->repo->emailExists($data->email)) {
            throw new \Exception('Email already exists. Please use a different email.');
        } elseif ($this->repo->phoneNumberExists($data->phone_number)) {
            throw new \Exception('Phone Number already exists. Please use a different phone number.');
        }

        $user = new User(
            name: $data->name,
            phone_number: $data->phone_number,
            email: $data->email,
            profile_photo_path: $data->profile_photo_path,
            password: $data->password,
        );

        return $this->repo->register($user);
    }
}
