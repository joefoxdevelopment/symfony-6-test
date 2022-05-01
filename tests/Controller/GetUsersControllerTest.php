<?php

declare(strict_types=1);

namespace App\Test\Controller\Users;

use App\Controller\Users\GetUsersController;
use App\Dal\UserDalInterface;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\Response;

class GetUsersControllerTest extends TestCase
{
    use ProphecyTrait;

    private ObjectProphecy $userDal;

    private GetUsersController $controller;

    public function setUp(): void
    {
        $this->userDal = $this->prophesize(UserDalInterface::class);

        $this->controller = new GetUsersController($this->userDal->reveal());
    }

    public function testIsInvokable(): void
    {
        $this->assertIsCallable($this->controller);
    }

    public function testInvokeReturnsJsonResponseWithUsers(): void
    {
        $this->userDal->getUsers()
            ->shouldBeCalledOnce()
            ->willReturn([new User('Name', 100)]);

        $response = ($this->controller)();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(
            [['name' => 'Name', 'age' => 100]],
            json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR)
        );
    }
}
