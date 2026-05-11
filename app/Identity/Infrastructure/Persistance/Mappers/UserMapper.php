<?php

namespace App\Identity\Infrastructure\Persistance\Mappers;

use App\Identity\Domain\Entities\User;
use Modules\Identity\Infrastructure\Persistance\Eloquent\UserModel;

class UserMapper
{
    public static function toModelArray(User $user): array
    {
        return [
            'name' => $user->name,
            'phone_number' => $user->phone_number,
            'email' => $user->email,
            'profile_photo_path' => $user->profile_photo_path,
            'password' => $user->password,
        ];
    }

    public static function toEntity(UserModel $user): User
    {
        return new User(
            name: $user->name,
            phone_number: $user->phone_number,
            email: $user->email,
            profile_photo_path: $user->profile_photo_path,
            password: $user->password,
        );
    }
}
