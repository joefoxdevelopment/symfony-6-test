<?php

declare(strict_types=1);

namespace App\Users;

use App\Dal\UserDalInterface;

class SearchFactory
{
    function __invoke(UserDalInterface $userDal): Search
    {
        return new Search($userDal);
    }
}
