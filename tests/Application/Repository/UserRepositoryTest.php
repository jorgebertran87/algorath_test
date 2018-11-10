<?php
declare(strict_types=1);

namespace Tests\Application\Repository;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Connections;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use AlgorathTest\Domain\Users;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    /** @var  UserRepository $userRepository */
    private $userRepository;
    private $user;

    private const ID    = '1';
    private const NAME  = 'Name 1';
    private const ID2   = '2';
    private const NAME2 = 'Name 2';

    protected function setUp(): void
    {
        $this->userRepository = new UserRepositoryStub();
        $this->user           = new User(new Id(self::ID), new Name(self::NAME));

        $this->userRepository->add($this->user);
        parent::setUp();
    }

    public function testItAddsAnUser(): void
    {
        $users = $this->userRepository->all();

        Assert::assertInstanceOf(Users::class, $users);
        Assert::assertCount(1, $users);
    }

    public function testItAddsAConnectionToAnUser(): void
    {
        $user2 = new User(new Id(self::ID2), new Name(self::NAME2));

        $this->userRepository->addConnection($this->user, $user2);

        $connections = $this->userRepository->getConnectionsFromId($this->user->id());

        Assert::assertInstanceOf(Connections::class, $connections);
        Assert::assertCount(1, $connections);
    }
}
