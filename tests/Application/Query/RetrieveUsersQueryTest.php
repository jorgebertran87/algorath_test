<?php
declare(strict_types=1);

namespace Tests\Application\Query;

use AlgorathTest\Application\Query\RetrieveUsersQuery;
use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use AlgorathTest\Domain\Users;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class RetrieveUsersQueryTest extends TestCase
{
    /** @var  User $user1 */
    private $user1;
    /** @var  User $user2 */
    private $user2;
    /** @var  UserRepository $userRepository */
    private $userRepository;
    private $queryBus;

    private const ID1   = '1';
    private const NAME1 = 'Name 1';
    private const ID2   = '2';
    private const NAME2 = 'Name 2';

    protected function setUp(): void
    {
        parent::setUp();

        $this->queryBus       = new QueryBusStub();
        $this->user1          = new User(new Id(self::ID1), new Name(self::NAME1));
        $this->user2          = new User(new Id(self::ID2), new Name(self::NAME2));
        $this->userRepository = $this->queryBus->userRepository();
    }

    public function testItRetrievesUsers(): void
    {
        $this->userRepository->add($this->user1);
        $this->userRepository->add($this->user2);

        $query = new RetrieveUsersQuery();

        $users = $this->queryBus->handle($query);

        Assert::assertInstanceOf(Users::class, $users);
        Assert::assertCount(2, $users);
    }
}
