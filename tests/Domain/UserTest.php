<?php
declare(strict_types=1);

namespace Tests\Domain;

use AlgorathTest\Domain\Connections;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private const ID    = '1';
    private const NAME  = 'User 1';
    private const ID2   = '2';
    private const NAME2 = 'User 2';

    /** @var  User $user1 */
    private $user1;
    /** @var  User $user2 */
    private $user2;

    protected function setUp()
    {
        parent::setUp();
        $this->user1 = new User(new Id(self::ID), new Name(self::NAME));
        $this->user2 = new User(new Id(self::ID2), new Name(self::NAME2));
    }

    public function testItReturnsAValidUser()
    {
        Assert::assertInstanceOf(User::class, $this->user1);
    }

    public function testItReturnsConnectionsFromUser()
    {
        $connections = Connections::create([$this->user2]);
        $this->user1->addConnections($connections);
        Assert::assertSame($connections, $this->user1->connections());
    }
}
