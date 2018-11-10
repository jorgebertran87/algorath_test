<?php
declare(strict_types=1);

namespace Tests\Application\Command;

use AlgorathTest\Application\Command\AddConnectionBetweenUsersCommand;
use AlgorathTest\Application\Command\AddConnectionBetweenUsersCommandHandler;
use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Tests\Application\Repository\UserRepositoryStub;

class AddConnectionBetweenUsersCommandTest extends TestCase
{
    private $user1;
    private $user2;
    /** @var  UserRepository $userRepository */
    private $userRepository;

    private const ID1   = '1';
    private const NAME1 = 'Name 1';
    private const ID2   = '2';
    private const NAME2 = 'Name 2';

    protected function setUp(): void
    {
        parent::setUp();

        $this->user1           = new User(new Id(self::ID1), new Name(self::NAME1));
        $this->user2           = new User(new Id(self::ID2), new Name(self::NAME2));
        $this->userRepository  = new UserRepositoryStub();
    }

    public function testItAddsConnectionBetweenUsers()
    {
        $this->userRepository->add($this->user1);
        $this->userRepository->add($this->user2);

        $command = new AddConnectionBetweenUsersCommand(
            $this->user1,
            $this->user2,
            $this->userRepository
        );

        $handler = new AddConnectionBetweenUsersCommandHandler($command);
        $handler->handle();

        $this->assertConnectionsForAllUsers();
    }

    private function assertConnectionsForAllUsers(): void
    {
        $users = $this->userRepository->all();

        /** @var User $user */
        foreach($users as $user) {
            Assert::assertCount(
                1,
                $this->userRepository->getConnectionsFromId($user->id())
            );
        }
    }
}
