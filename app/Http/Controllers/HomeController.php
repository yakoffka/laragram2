<?php

namespace App\Http\Controllers;

use App\Notifications\TestNotify;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class HomeController extends Controller
{
    use Notifiable;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sendTestNotification()
    {
        $this->notify(new TestNotify(__METHOD__));
        // dd('hello');
    }
}
