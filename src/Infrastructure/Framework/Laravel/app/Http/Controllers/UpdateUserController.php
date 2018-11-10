<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use AlgorathTest\Application\Command\CommandBus;
use AlgorathTest\Application\Command\UpdateUserCommand;
use AlgorathTest\Application\Command\UpdateUserCommandHandler;
use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use AlgorathTest\Infrastructure\Framework\Laravel\app\Services\ConnectionsParser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;

final class UpdateUserController extends Controller
{
    public function handle(
        CommandBus $commandBus,
        UserRepository $userRepository,
        ConnectionsParser $connectionsParser,
        string $id
    ): RedirectResponse
    {
        $id          = new Id($id);
        $name        = new Name(Input::get('name'));
        $currentUser = new User($id, $name);
        $connections = $connectionsParser->parse(Input::get('connections', null));

        $currentUser->addConnections($connections);

        $command = new UpdateUserCommand($currentUser, $userRepository);
        $commandBus->handle($command);

        return redirect('/');
    }

    protected function injectCommandQueryDependencies(): void
    {
        CommandBus::use([UpdateUserCommand::class => UpdateUserCommandHandler::class]);
    }
}