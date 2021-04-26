<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Configuration;
use Livewire\Component;

class Top extends Component
{
    public $top;

    public function mount(): void
    {
        $this->top = Configuration::orderBy("counts", "DESC")->take(5)->get();
    }
    public function render(): \Illuminate\View\View
    {
        return view('livewire.dashboard.top');
    }
}
