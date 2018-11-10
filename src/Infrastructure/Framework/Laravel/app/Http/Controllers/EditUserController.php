<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use AlgorathTest\Application\Query\QueryBus;
use AlgorathTest\Application\Query\RetrieveConnectionsFromUserQuery;
use AlgorathTest\Application\Query\RetrieveConnectionsFromUserQueryHandler;
use AlgorathTest\Application\Query\RetrieveUsersQuery;
use AlgorathTest\Application\Query\RetrieveUsersQueryHandler;
use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Id;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class EditUserController extends Controller
{
    /** @return View|RedirectResponse */
    public function handle(
        QueryBus $queryBus,
        UserRepository $userRepository,
        string $id
    )
    {
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

    protected function injectCommandQueryDependencies(): void
    {
        QueryBus::use(
            [
                RetrieveConnectionsFromUserQuery::class => RetrieveConnectionsFromUserQueryHandler::class,
                RetrieveUsersQuery::class => RetrieveUsersQueryHandler::class
            ]
        );
    }
}