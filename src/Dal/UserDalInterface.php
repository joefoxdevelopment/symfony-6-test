<?php

namespace App\Dal;

use App\Entity\User;

interface UserDalInterface
{
    public function getUsers(): array;
    public function getUserByName(string $name): User;
}
