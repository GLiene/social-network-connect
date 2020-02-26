<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function getResults(Request $request)
    {
        $searchQuery = $request->input('searchQuery');

        $users = User::where('name', 'LIKE', '%' . $searchQuery . '%')
        ->orWhere('surname', 'LIKE', '%' . $searchQuery . '%')->get();

        return view('search.results', compact('users'));
    }
}

