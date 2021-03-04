<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Configuration;
use Livewire\Component;

class Latest extends Component
{
    public $latest;

    public function mount()
    {
        $this->latest = Configuration::latest("updated_at")->take(5)->get();
    }
    public function render()
    {

        return view('livewire.dashboard.latest');
    }
}
