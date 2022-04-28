<?php

declare(strict_types=1);

namespace App\Dal;

use App\Entity\User;

class UserDal implements UserDalInterface
{
    public function getUsers(): array
    {
        return [
            new User('Joe', 26),
            new User('Mark C', 100),
            new User('Dan', 21),
        ];
    }

    public function getUserByName(string $name): User
    {
        $users = $this->getUsers();

        foreach ($users as $user)
        {
            if (strtolower($user->getName()) === strtolower($name))
            {
                return $user;
            }
        }

        throw new \InvalidArgumentException('User "' . $name . '" could not be found');
    }
}
