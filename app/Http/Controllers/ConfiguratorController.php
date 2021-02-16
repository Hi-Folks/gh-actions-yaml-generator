<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguratorController extends Controller
{
    public function index()
    {
        $data = [];
        $data["title"] = "Ghygen is a GitHub Actions configurator for your Laravel Application.";
        $data["description"] = "Setup Database Service, use multiple PHP version,
            use multiple Laravel versions, build frontend, cache packages,
            execute Browser, Functional, and Unit tests…";
        return view('configurator.index', $data);
    }
}
