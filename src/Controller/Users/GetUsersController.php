<?php

declare(strict_types=1);

namespace App\Controller\Users;

use App\Dal\UserDalInterface;
use Symfony\Component\HttpFoundation\Response;

class GetUsersController
{
    public function __construct(public UserDalInterface $userDal)
    {}

    public function __invoke(): Response
    {
        $users = $this->userDal->getUsers();

        foreach ($users as $index => $user) {
            $users[$index] = $user->toArray();
        }

        return new Response(json_encode($users));
    }
}
