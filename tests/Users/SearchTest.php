<?php

declare(strict_types=1);

namespace App\Test\Users;

use App\Dal\UserDalInterface;
use App\Entity\User;
use App\Users\Search;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

class SearchTest extends TestCase
{
    use ProphecyTrait;

    private ObjectProphecy $userDal;

    private Search $search;

    public function setUp(): void
    {
        $this->userDal = $this->prophesize(UserDalInterface::class);

        $this->search = new Search($this->userDal->reveal());
    }

    public function testSearchByNameReturnsFoundUser(): void
    {
        $user = new User('Name', 100);

        $this->userDal->getUserByName('KnownPerson')
            ->shouldBeCalledOnce()
            ->willReturn($user);

        $this->assertSame(
            $user,
            $this->search->searchByName('KnownPerson')
        );
    }

    public function testSearchByNameReturnsNullWhenUserNotFound(): void
    {
        $this->userDal->getUserByName('NotKnownPerson')
            ->shouldBeCalledOnce()
            ->willThrow(InvalidArgumentException::class);

        $this->assertNull($this->search->searchByName('NotKnownPerson'));
    }
}
