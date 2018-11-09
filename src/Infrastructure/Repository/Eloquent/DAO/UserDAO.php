<?php

namespace AlgorathTest\Infrastructure\Repository\Eloquent\DAO;

use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use AlgorathTest\Domain\Users;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class UserDAO extends Model
{
    protected $table = 'users';

    public $incrementing = false;

    public function connections(): Collection
    {
        $connections1 = $this->connectionsFromField1;
        $connections2 = $this->connectionsFromField2;
        return collect(array_merge($connections1->toArray(), $connections2->toArray()));
    }

    public function connectionsFromField1(): HasMany
    {
        return $this->hasMany(ConnectionDAO::class, 'user_id1');
    }

    public function connectionsFromField2(): HasMany
    {
        return $this->hasMany(ConnectionDAO::class, 'user_id2');
    }

    public static function  toUsersCollection(Collection $collection): Users
    {
        $users = array_map(
            function($userDAO)
            {
                $user = new User(new Id($userDAO['id']), new Name($userDAO['name']));
                return $user;
            }
            ,
            $collection->toArray()
        );

        return Users::create($users);
    }
}