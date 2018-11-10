<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 5/11/18
 * Time: 16:40
 */

namespace Tests\Domain;

use AlgorathTest\Domain\Collection;
use AlgorathTest\Domain\Connections;
use AlgorathTest\Domain\Exceptions\ConnectionNotValid;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ConnectionsTest extends TestCase
{
    public function testItReturnsAValidCollection()
    {
        $user = new User(new Id('1'), new Name('Name 1'));
        $connections = Connections::create([$user]);
        Assert::assertInstanceOf(Collection::class, $connections);
    }

    public function testItThrowsConnectionNotValid()
    {
        $user = 'user';
        $this->expectException(ConnectionNotValid::class);
        Connections::create([$user]);
    }
}
