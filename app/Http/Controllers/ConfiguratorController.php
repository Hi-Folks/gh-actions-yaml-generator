<?php

namespace App\Http\Controllers;

class ConfiguratorController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $data = [];
        $data["title"] = "Ghygen is a GitHub Actions configurator for your Laravel Application.";
        $data["description"] = "Setup Database Service, use multiple PHP version,
            use multiple Laravel versions, build frontend, cache packages,
            execute Browser, Functional, and Unit tests…";
        return view('configurator.index', $data);
    }

    public function about(): \Illuminate\View\View
    {
        $data = [];
        $data["title"] = "Generate GitHub Actions Config for Laravel Projects with Ghygen";
        $data["description"] = "Setup Database Service, use multiple PHP version,
            use multiple Laravel versions, build frontend, cache packages,
            execute Browser, Functional, and Unit tests…";
        return view('configurator.about', $data);
    }
}
