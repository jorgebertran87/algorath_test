<?php

namespace AlgorathTest\Infrastructure\Repository\Eloquent\DAO;

use AlgorathTest\Domain\Connections;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use Illuminate\Database\Eloquent\Model;

class ConnectionDAO extends Model
{
    protected $table = 'connections';

    public $incrementing = false;

    public static function  toConnectionsCollection(UserDAO $currentUser): Connections
    {
        $connections = $currentUser->connections();

        $users = array_map(
            function($connectionDAO) use($currentUser)
            {
                $userDAO = null;
                if ($connectionDAO['user_id1'] === $currentUser->id) {
                    $userDAO = UserDAO::find($connectionDAO['user_id2']);
                } else {
                    $userDAO = UserDAO::find($connectionDAO['user_id1']);
                }
                $user = new User(new Id($userDAO['id']), new Name($userDAO['name']));
                return $user;
            },
            $connections->toArray()
        );

        return Connections::create($users);
    }
}