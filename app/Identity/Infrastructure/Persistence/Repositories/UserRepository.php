<?php

namespace App\Identity\Infrastructure\Persistence\Repositories;

use App\Identity\Domain\Entities\User;
use App\Identity\Domain\Repositories\UserRepositoryInterface;
use App\Identity\Domain\ValueObjects\Email;
use App\Identity\Domain\ValueObjects\PhoneNumber;
use App\Identity\Infrastructure\Persistence\Eloquent\UserModel;
use App\Identity\Infrastructure\Persistence\Mappers\UserMapper;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function register(User $user): User
    {
        $created_user = UserModel::create(UserMapper::toModelArray($user));

        event(new Registered($created_user));

        Auth::login($created_user);

        return UserMapper::toEntity($created_user);
    }

    public function phoneNumberExists(PhoneNumber $phoneNumber): bool
    {
        return UserModel::where('phone_number', $phoneNumber)->exists();
    }

    public function emailExists(Email $contactEmail): bool
    {
        return UserModel::where('contact_email', $contactEmail)->exists();
    }
}
