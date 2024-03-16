<?php

namespace App\Livewire\Dashboard;

use App\Models\Configuration;
use Livewire\Component;

class Latest extends Component
{
    /**
     * @var mixed
     */
    public $latest;

    public function mount(): void
    {
        $this->latest = Configuration::latest('updated_at')->take(5)->get();
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.dashboard.latest');
    }
}
