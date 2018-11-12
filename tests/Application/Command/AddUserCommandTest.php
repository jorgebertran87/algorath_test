<?php
declare(strict_types=1);

namespace Tests\Application\Command;

use AlgorathTest\Application\Command\AddUserCommand;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class AddUserCommandTest extends TestCase
{
    private $commandBus;
    private $userRepository;

    private const NAME = 'Name 1';

    protected function setUp(): void
    {
        parent::setUp();

        $this->commandBus     = new CommandBusStub();
        $this->userRepository = $this->commandBus->userRepository();
    }

    public function testItAddsUserIntoRepository()
    {

        $command = new AddUserCommand(self::NAME);
        $this->commandBus->handle($command);

        Assert::assertCount(1, $this->userRepository->all());
    }
}
