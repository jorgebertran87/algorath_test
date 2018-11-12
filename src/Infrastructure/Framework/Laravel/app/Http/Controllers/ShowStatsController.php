<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use AlgorathTest\Application\Query\QueryBus;
use AlgorathTest\Application\Query\RetrieveUsersWithConnectionsQuery;
use Illuminate\Routing\Controller;
use Illuminate\View\View;


final class ShowStatsController extends Controller
{
    public function handle(
        QueryBus $queryBus
    ): View
    {
        $query = new RetrieveUsersWithConnectionsQuery();
        $users = $queryBus->handle($query);

        return view('stats', compact('users'));
    }
}