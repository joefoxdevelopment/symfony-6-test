<?php

declare(strict_types=1);

namespace App\Users;

use App\Entity\User;
use App\Dal\UserDalInterface;

class Search
{
    public function __construct(private UserDalInterface $userDal)
    {
    }

    public function searchByName(string $name): ?User
    {
        try {
            return $this->userDal->getUserByName($name);
        } catch (\InvalidArgumentException $e) {
            return null;
        }
    }
}
