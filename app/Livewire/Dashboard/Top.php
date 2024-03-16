<?php

namespace App\Livewire\Dashboard;

use App\Models\Configuration;
use Livewire\Component;

class Top extends Component
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection<int,\App\Models\Configuration>
     */
    public $top;

    public function mount(): void
    {
        $this->top = Configuration::orderBy('counts', 'DESC')->take(5)->get();
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.dashboard.top');
    }
}
