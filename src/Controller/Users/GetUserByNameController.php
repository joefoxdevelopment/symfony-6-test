<?php

declare(strict_types=1);

namespace App\Controller\Users;

use App\Dal\UserDalInterface;
use App\Users\Search;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetUserByNameController
{
    public function __construct(private Search $search)
    {
    }

    public function __invoke(Request $request): Response
    {
        $user = $this->search->searchByName((string) $request->query->get('name', ''));

        if (null === $user) {
            return new Response((string) json_encode([], JSON_THROW_ON_ERROR));
        }

        return new Response((string) json_encode($user->toArray(), JSON_THROW_ON_ERROR));
    }
}
