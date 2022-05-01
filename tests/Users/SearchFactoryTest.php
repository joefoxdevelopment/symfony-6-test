<?php

declare(strict_types=1);

namespace App\Test\Users;

use App\Dal\UserDalInterface;
use App\Users\Search;
use App\Users\SearchFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

class SearchFactoryTest extends TestCase
{
    use ProphecyTrait;

    private ObjectProphecy $userDal;

    private SearchFactory $factory;

    public function setUp(): void
    {
        $this->userDal = $this->prophesize(UserDalInterface::class);
        $this->factory = new SearchFactory();
    }

    public function testIsInvokable(): void
    {
        $this->assertIsCallable($this->factory);
    }

    public function testInvokeReturnsSearch(): void
    {
        $search = ($this->factory)($this->userDal->reveal());

        $this->assertInstanceOf(Search::class, $search);
    }
}
