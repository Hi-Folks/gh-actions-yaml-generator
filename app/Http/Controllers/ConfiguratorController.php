<?php

namespace App\Http\Controllers;

class ConfiguratorController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        return view('configurator.index');
    }

    public function about(): \Illuminate\View\View
    {
        return view('configurator.about', [
            'title' => config('gh-action-yaml-generator.data.title_about'),
            'description' => config('gh-action-yaml-generator.data.description'),
        ]);
    }
}
