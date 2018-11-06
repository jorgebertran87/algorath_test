<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Query;

use AlgorathTest\Domain\Users;

class RetrieveUsersQueryHandler
{
    private $retrieveUsersQuery;

    public function __construct(RetrieveUsersQuery $retrieveUsersQuery)
    {
        $this->retrieveUsersQuery = $retrieveUsersQuery;
    }

    public function handle(): Users
    {
        $userRepository = $this->retrieveUsersQuery->userRepository();

        return $userRepository->all();
    }
}