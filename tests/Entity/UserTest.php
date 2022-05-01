<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        $this->user = new User('Name', 100);
    }

    public function testGetNameReturnsName(): void
    {
        $this->assertEquals('Name', $this->user->getName());
    }

    public function testGetAgeReturnsAge(): void
    {
        $this->assertEquals(100, $this->user->getAge());
    }

    public function testToArrayReturnsEntityAsArray(): void
    {
        $this->assertSame(
            [
                'name' => 'Name',
                'age'  => 100,
            ],
            $this->user->toArray(),
        );
    }
}
