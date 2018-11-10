<?php
declare(strict_types=1);

namespace Tests\Application\Query;

use AlgorathTest\Application\Query\RetrieveConnectionsFromUserQuery;
use AlgorathTest\Application\Query\RetrieveConnectionsFromUserQueryHandler;
use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Connections;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Tests\Application\Repository\UserRepositoryStub;

class RetrieveConnectionsFromUserQueryTest extends TestCase
{
    /** @var  User $user1 */
    private $user1;
    /** @var  User $user2 */
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

        $this->user1          = new User(new Id(self::ID1), new Name(self::NAME1));
        $this->user2          = new User(new Id(self::ID2), new Name(self::NAME2));
        $this->userRepository = new UserRepositoryStub();
    }

    public function testItRetrievesConnectionsFromUser(): void
    {
        $this->userRepository->add($this->user1);
        $this->userRepository->add($this->user2);
        $this->userRepository->addConnection($this->user1, $this->user2);

        $command = new RetrieveConnectionsFromUserQuery($this->user2->id(), $this->userRepository);
        $handler = new RetrieveConnectionsFromUserQueryHandler($command);

        $connections = $handler->handle();

        Assert::assertInstanceOf(Connections::class, $connections);
        Assert::assertCount(1, $connections);
    }
}