<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Query;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Connections;
use AlgorathTest\Domain\Id;

class RetrieveConnectionsFromUserQueryHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(RetrieveConnectionsFromUserQuery $retrieveConnectionsFromUserQuery): Connections
    {
        $id = $retrieveConnectionsFromUserQuery->id();

        return $this->userRepository->getConnectionsFromId(new Id($id));
    }
}