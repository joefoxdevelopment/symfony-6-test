<?php

declare(strict_types=1);

namespace App\Test\Dal;

use App\Dal\UserDal;
use App\Dal\UserDalInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UserDalTest extends TestCase
{
    private UserDal $dal;

    public function setUp(): void
    {
        $this->dal = new UserDal();
    }

    public function testImplementsUserDalInterface(): void
    {
        $this->assertInstanceOf(UserDalInterface::class, $this->dal);
    }

    public function testGetUsersReturnsArrayOfUsers(): void
    {
        $this->assertIsArray($this->dal->getUsers());
    }

    public function testGetUserByNameReturnsUserWhenNameFound(): void
    {
        $expected = [
            'name' => 'Person2',
            'age'  => 100,
        ];

        $this->assertSame(
            $expected,
            $this->dal->getUserByName('Person2')->toArray(),
        );
    }

    public function testGetUserByNameThrowsInvalidArgumentExceptionWhenUserNotFound(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->dal->getUserByName('NotKnownUser');
    }
}
