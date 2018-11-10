<?php

namespace AlgorathTest\Infrastructure\Framework\Laravel\app\Services;

use AlgorathTest\Domain\Connections;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;

final class ConnectionsParser
{
    public function parse(?array $userIds): Connections
    {
        $connections = Connections::create([]);
        if ($userIds) {
            foreach($userIds as $userId) {
                //The name is not important
                $connection = new User(new Id($userId), new Name('jeje'));
                $connections->add($connection);
            }
        }

        return $connections;
    }
}