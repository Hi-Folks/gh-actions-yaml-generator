<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Configuration;
use App\Models\LogConfiguration;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Daily extends Component
{
    public $daily;

    public function mount(): void
    {
        $date = DB::raw('DATE(`created_at`) as `date`');
        if (config('database.default') === 'pgsql') {
            $date = DB::raw("date_trunc('day', created_at) as date");
        }
        $this->daily = LogConfiguration::select(array(
            $date,
            DB::raw('count(*) as count')
        ))
            ->groupBy('date')
            ->orderBy('date', 'DESC') // or ASC
            ->pluck('count', 'date');
    }
    public function render(): \Illuminate\View\View
    {
        return view('livewire.dashboard.daily');
    }
}
