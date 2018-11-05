<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Repository;

use AlgorathTest\Domain\Connections;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\User;
use AlgorathTest\Domain\Users;

interface UserRepository
{
    public function add(User $user): void;

    public function update(User $user): void;

    public function addConnection(User $user1, User $user2): void;

    public function getConnectionsFromId(Id $id): Connections;

    public function removeConnections(User $user): void;

    public function findById(Id $id): ?User;

    public function all(): Users;
}