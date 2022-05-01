<?php

namespace App\Dal;

use App\Entity\User;

interface UserDalInterface
{
    /**
     * @return array<User>
     */
    public function getUsers(): array;

    public function getUserByName(string $name): User;
}
