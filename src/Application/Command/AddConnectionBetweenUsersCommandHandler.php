<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Command;

class AddConnectionBetweenUsersCommandHandler
{
    private $addConnectionBetweenUsersCommand;

    public function __construct(AddConnectionBetweenUsersCommand $addConnectionBetweenUsersCommand)
    {
        $this->addConnectionBetweenUsersCommand = $addConnectionBetweenUsersCommand;
    }

    public function handle(): void
    {
        $user1          = $this->addConnectionBetweenUsersCommand->user1();
        $user2          = $this->addConnectionBetweenUsersCommand->user2();
        $userRepository = $this->addConnectionBetweenUsersCommand->userRepository();

        $userRepository->addConnection($user1, $user2);
    }
}