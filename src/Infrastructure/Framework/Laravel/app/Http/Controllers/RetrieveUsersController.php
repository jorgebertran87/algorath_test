<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use AlgorathTest\Application\Query\QueryBus;
use AlgorathTest\Application\Query\RetrieveUsersQuery;
use Illuminate\Routing\Controller;
use Illuminate\View\View;


final class RetrieveUsersController extends Controller
{
    public function handle(
        QueryBus $queryBus
    ): View
    {
        $query = new RetrieveUsersQuery();
        $users = $queryBus->handle($query);

        return view('users', compact('users'));
    }
}