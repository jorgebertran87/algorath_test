<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use AlgorathTest\Application\Query\QueryBus;
use AlgorathTest\Application\Query\RetrieveConnectionsFromUserQuery;
use AlgorathTest\Application\Query\RetrieveUsersQuery;
use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Id;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
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

        $query       = new RetrieveConnectionsFromUserQuery($id);
        $connections = $queryBus->handle($query);

        $query = new RetrieveUsersQuery();
        $users = $queryBus->handle($query);

        return view('users_edit', compact('user', 'connections', 'users'));
    }
}