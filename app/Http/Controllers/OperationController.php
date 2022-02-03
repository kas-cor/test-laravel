<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        if ($keywords = $request->input('keywords')) {
            $operations = Auth::user()
                ->operations()
                ->sortable(['created_at' => 'desc'])
                ->whereRaw("MATCH (description) AGAINST (? IN BOOLEAN MODE)", $keywords)
                ->paginate()
                ->withQueryString();
        } else {
            $operations = Auth::user()
                ->operations()
                ->sortable(['created_at' => 'desc'])
                ->paginate()
                ->withQueryString();
        }

        return view('operations', [
            'operations' => $operations,
        ]);
    }
}
