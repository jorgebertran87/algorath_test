<?php
declare(strict_types=1);

namespace Tests\Application\Command;

use AlgorathTest\Application\Command\AddUserCommand;
use AlgorathTest\Application\Command\AddUserCommandHandler;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Tests\Application\Repository\UserRepositoryStub;

class AddUserCommandTest extends TestCase
{
    private $user;
    private $userRepository;

    private const ID   = '1';
    private const NAME = 'Name 1';

    protected function setUp(): void
    {
        parent::setUp();

        $this->user           = new User(new Id(self::ID), new Name(self::NAME));
        $this->userRepository = new UserRepositoryStub();
    }

    public function testItAddsUserIntoRepository()
    {
        $command = new AddUserCommand($this->user, $this->userRepository);

        $handler = new AddUserCommandHandler($command);
        $handler->handle();

        Assert::assertCount(1, $this->userRepository->all());
    }
}
