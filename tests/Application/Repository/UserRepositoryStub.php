<?php
declare(strict_types=1);

namespace Tests\Application\Repository;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Connections;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\User;
use AlgorathTest\Domain\Users;

final class UserRepositoryStub implements UserRepository
{
    private $users;

    public function __construct()
    {
        $this->users = Users::create([]);
    }

    public function add(User $user): void
    {
        $this->users->add($user);
    }

    public function addConnection(User $user1, User $user2): void
    {
        /** @var User $user */
        foreach($this->users as $user) {
            if ($user->equals($user1)) {
                $user->addConnections(Connections::create([$user2]));
            }

            if ($user->equals($user2)) {
                $user->addConnections(Connections::create([$user1]));
            }
        }
    }

    public function getConnectionsFromId(Id $id): Connections
    {
        /** @var User $user */
        foreach($this->users as $user) {
            if ($user->id() === $id) {
                return $user->connections();
            }
        }

        return Connections::create([]);
    }

    public function all(): Users
    {
        return $this->users;
    }
}