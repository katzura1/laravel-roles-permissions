<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return 'Home Page Example';
    }

    public function master()
    {
        return 'Master Page Example';
    }
}
