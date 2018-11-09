<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Command;

class UpdateUserCommandHandler
{
    private $updateUserCommand;

    public function __construct(UpdateUserCommand $updateUserCommand)
    {
        $this->updateUserCommand = $updateUserCommand;
    }

    public function handle(): void
    {
        $userRepository = $this->updateUserCommand->userRepository();
        $user           = $this->updateUserCommand->user();

        $userRepository->update($user);
        $userRepository->removeConnections($user);


        $connections = $user->connections();

        foreach($connections as $connection) {
            $userRepository->addConnection($user, $connection);
        }
    }
}