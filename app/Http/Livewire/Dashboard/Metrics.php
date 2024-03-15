<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Configuration;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Metrics extends Component
{
    public int $count;

    public int $total;

    public int $last4hours;

    public int $last24hours;

    public int $last3days;

    public function mount(): void
    {
        $this->count = Configuration::count();
        $this->total = Configuration::sum('counts');
        $this->last4hours = Configuration::where(
            'updated_at',
            '>',
            Carbon::now()->subHours(3)->toDateTimeString()
        )->count();
        $this->last24hours = Configuration::where(
            'updated_at',
            '>',
            Carbon::now()->subHours(24)->toDateTimeString()
        )->count();
        $this->last3days = Configuration::where(
            'updated_at',
            '>',
            Carbon::now()->subHours(24 * 3)->toDateTimeString()
        )->count();
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.dashboard.metrics');
    }
}
