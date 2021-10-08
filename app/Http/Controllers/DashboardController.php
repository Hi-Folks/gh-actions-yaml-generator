<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        return view('dashboard.index');
    }
}
