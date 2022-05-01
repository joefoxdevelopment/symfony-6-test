<?php

declare(strict_types=1);

namespace App\Test\Controller\Users;

use App\Controller\Users\GetUserByNameController;
use App\Entity\User;
use App\Users\Search;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetUserByNameControllerTest extends TestCase
{
    use ProphecyTrait;

    private InputBag $query;
    private ObjectProphecy $request;
    private ObjectProphecy $search;

    private GetUserByNameController $controller;

    public function setUp(): void
    {
        $this->query = new InputBag(); // final class - can't be mocked

        $this->request = $this->prophesize(Request::class);
        $this->search  = $this->prophesize(Search::class);

        $this->request->query = $this->query;

        $this->controller = new GetUserByNameController($this->search->reveal());
    }

    public function testIsInvokable(): void
    {
        $this->assertIsCallable($this->controller);
    }

    public function testInvokeReturnsResponseWithEmptyJsonArrayWithNoNameQuery(): void
    {
        $this->search->searchByName('')
            ->shouldBeCalledOnce()
            ->willReturn(null);

        $response = ($this->controller)($this->request->reveal());

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(
            [],
            json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR)
        );
    }

    public function testInvokeReturnResponseWithUserWhenFound(): void
    {
        $this->query->set('name', 'UserName');

        $this->search->searchByName('UserName')
            ->shouldBeCalledOnce()
            ->willReturn(new User('UserName', 100));

        $response = ($this->controller)($this->request->reveal());

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(
            [
                'name' => 'UserName',
                'age'  => 100,
            ],
            json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR)
        );
    }
}
