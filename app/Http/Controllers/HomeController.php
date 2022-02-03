<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function __invoke()
    {
        $operations = Auth::user()
            ->operations()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('home', [
            'operations' => $operations,
        ]);
    }
}
