<?php

namespace AlgorathTest\Infrastructure\Repository\Eloquent;

use AlgorathTest\Application\Repository\UserRepository as UserRepositoryInterface;
use AlgorathTest\Domain\Connections;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use AlgorathTest\Domain\Users;
use AlgorathTest\Infrastructure\Repository\Eloquent\DAO\ConnectionDAO;
use AlgorathTest\Infrastructure\Repository\Eloquent\DAO\UserDAO;


class UserRepository implements UserRepositoryInterface
{

    public function add(User $user): void
    {
        $dao       = new UserDAO();
        $dao->id   = (string)$user->id();
        $dao->name = (string)$user->name();

        $dao->save();
    }

    public function update(User $user): void
    {
        /** @var UserDAO $dao */
        $dao       = UserDAO::find($user->id());
        $dao->name = (string)$user->name();

        $dao->save();
    }

    public function addConnection(User $user1, User $user2): void
    {

        $connections = $this->getConnectionsFromId($user1->id());

        $found = false;
        /** @var User $connection */
        foreach($connections as $connection) {
            if ($connection->equals($user2)) {
                $found = true;
            }
        }

        if (!$found) {
            $newConnection = new ConnectionDAO();
            $newConnection->user_id1 = $user1->id();
            $newConnection->user_id2 = $user2->id();
            $newConnection->save();
        }
    }

    public function getConnectionsFromId(Id $id): Connections
    {
        $user = UserDAO::find($id);
        return ConnectionDAO::toConnectionsCollection($user);
    }

    public function all(): Users
    {
        $users = UserDAO::toUsersCollection(UserDAO::all());
        return $users;
    }

    public function findById(Id $id): ?User
    {
        $userDAO = UserDAO::find($id);

        if ($userDAO) {
            $user = new User($id, new Name($userDAO->name));
            return $user;
        }

        return null;
    }

    public function removeConnections(User $user): void
    {
        /** @var UserDAO $userDAO */
        $userDAO = UserDAO::find($user->id());
        $userDAO->connectionsFromField1()->delete();
        $userDAO->connectionsFromField2()->delete();
    }
}