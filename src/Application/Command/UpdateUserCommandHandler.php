<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Command;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Application\Service\ConnectionsParser;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;

class UpdateUserCommandHandler
{
    private $userRepository;
    private $connectionsParser;

    public function __construct(UserRepository $userRepository, ConnectionsParser $connectionsParser)
    {
        $this->userRepository    = $userRepository;
        $this->connectionsParser = $connectionsParser;
    }

    public function handle(UpdateUserCommand $updateUserCommand): void
    {
        $id               = $updateUserCommand->id();
        $name             = $updateUserCommand->name();
        $connectedUserIds = $updateUserCommand->connectedUserIds();

        $user = new User(new Id($id), new Name($name));

        $this->userRepository->update($user);
        $this->userRepository->removeConnections($user);

        $connections = $this->connectionsParser->parse($connectedUserIds);
        foreach($connections as $connection) {
            $this->userRepository->addConnection($user, $connection);
        }
    }
}