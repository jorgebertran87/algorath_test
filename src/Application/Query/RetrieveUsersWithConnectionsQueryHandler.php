<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Query;

use AlgorathTest\Domain\User;
use AlgorathTest\Domain\Users;

class RetrieveUsersWithConnectionsQueryHandler
{
    private $retrieveUsersWithConnectionsQuery;

    public function __construct(RetrieveUsersWithConnectionsQuery $retrieveUsersWithConnectionsQuery)
    {
        $this->retrieveUsersWithConnectionsQuery = $retrieveUsersWithConnectionsQuery;
    }

    public function handle(): Users
    {
        $userRepository = $this->retrieveUsersWithConnectionsQuery->userRepository();

        $users = $userRepository->all();

        /** @var User $user */
        foreach($users as $user) {
            $connections = $userRepository->getConnectionsFromId($user->id());
            $user->addConnections($connections);
        }

        return $users;
    }
}