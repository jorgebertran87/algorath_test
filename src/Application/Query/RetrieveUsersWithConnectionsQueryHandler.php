<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Query;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\User;
use AlgorathTest\Domain\Users;

class RetrieveUsersWithConnectionsQueryHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(): Users
    {
        $users = $this->userRepository->all();

        /** @var User $user */
        foreach($users as $user) {
            $connections = $this->userRepository->getConnectionsFromId($user->id());
            $user->addConnections($connections);
        }

        return $users;
    }
}