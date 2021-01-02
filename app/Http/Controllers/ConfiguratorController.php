<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguratorController extends Controller
{
    public function index()
    {
        return view('configurator.index');
    }
}
