<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Query;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Connections;
use AlgorathTest\Domain\Id;

class RetrieveConnectionsFromUserQueryHandler
{
    private $retrieveConnectionsFromUserQuery;

    public function __construct(RetrieveConnectionsFromUserQuery $retrieveConnectionsFromUserQuery)
    {
        $this->retrieveConnectionsFromUserQuery = $retrieveConnectionsFromUserQuery;
    }

    public function handle(): Connections
    {
        $userId         = $this->retrieveConnectionsFromUserQuery->userId();
        $userRepository = $this->retrieveConnectionsFromUserQuery->userRepository();

        return $userRepository->getConnectionsFromId($userId);
    }
}