<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use AlgorathTest\Application\Command\AddUserCommand;
use AlgorathTest\Application\Command\AddUserCommandHandler;
use AlgorathTest\Application\Command\CommandBus;
use AlgorathTest\Application\Command\UpdateUserCommand;
use AlgorathTest\Application\Command\UpdateUserCommandHandler;
use AlgorathTest\Application\Query\QueryBus;
use AlgorathTest\Application\Query\RetrieveConnectionsFromUserQuery;
use AlgorathTest\Application\Query\RetrieveConnectionsFromUserQueryHandler;
use AlgorathTest\Application\Query\RetrieveUsersQuery;
use AlgorathTest\Application\Query\RetrieveUsersQueryHandler;
use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use AlgorathTest\Infrastructure\Framework\Laravel\app\Services\ConnectionsParser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\View\View;

final class UsersController extends Controller
{
    public function retrieve(
        RetrieveUsersQueryHandler $retrieveUsersQueryHandler
    ): View
    {
        $users = $retrieveUsersQueryHandler->handle();

        return view('users', compact('users'));
    }

    public function new(): View
    {
        return view('users_new');
    }

    /** @return View|RedirectResponse */
    public function edit(
        QueryBus $queryBus,
        UserRepository $userRepository,
        string $id
    )
    {
        QueryBus::use(
            [
                RetrieveConnectionsFromUserQuery::class => RetrieveConnectionsFromUserQueryHandler::class,
                RetrieveUsersQuery::class => RetrieveUsersQueryHandler::class
            ]
        );

        $user = $userRepository->findById(new Id($id));

        if ($user === null) {
            return redirect('/');
        }

        $query = new RetrieveConnectionsFromUserQuery($user->id(), $userRepository);

        $connections = $queryBus->handle($query);

        $query = new RetrieveUsersQuery($userRepository);
        $users = $queryBus->handle($query);

        return view('users_edit', compact('user', 'connections', 'users'));
    }

    public function create(CommandBus $commandBus, UserRepository $userRepository): RedirectResponse
    {
        CommandBus::use([AddUserCommand::class => AddUserCommandHandler::class]);

        $randomId = Id::generateRandom();
        $name     = new Name(Input::get('name'));
        $user     = new User($randomId, $name);

        $command = new AddUserCommand($user,$userRepository);
        $commandBus->handle($command);
        return redirect('/');
    }

    public function update(
        CommandBus $commandBus,
        UserRepository $userRepository,
        ConnectionsParser $connectionsParser,
        string $id
    ): RedirectResponse
    {
        CommandBus::use([UpdateUserCommand::class => UpdateUserCommandHandler::class]);

        $id          = new Id($id);
        $name        = new Name(Input::get('name'));
        $currentUser = new User($id, $name);
        $connections = $connectionsParser->parse(Input::get('connections', null));

        $currentUser->addConnections($connections);

        $command = new UpdateUserCommand($currentUser, $userRepository);
        $commandBus->handle($command);

        return redirect('/');
    }
}