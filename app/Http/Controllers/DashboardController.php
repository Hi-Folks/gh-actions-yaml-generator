<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data["title"] = "Ghygen is a GitHub Actions configurator for your Laravel Application.";
        $data["description"] = "Setup Database Service, use multiple PHP version,
            use multiple Laravel versions, build frontend, cache packages,
            execute Browser, Functional, and Unit tests…";
        return view('dashboard.index', $data);
    }
}
