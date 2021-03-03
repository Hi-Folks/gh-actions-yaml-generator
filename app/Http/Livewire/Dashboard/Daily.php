<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Configuration;
use App\Models\LogConfiguration;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Daily extends Component
{
    public $daily;

    public function mount()
    {
        $this->daily = LogConfiguration::select(array(
            DB::raw('DATE(`created_at`) as `date`'),
            DB::raw('count(*) as `count`')
        ))
            ->groupBy('date')
            ->orderBy('date', 'DESC') // or ASC
            ->pluck('count', 'date');
    }
    public function render()
    {
        return view('livewire.dashboard.daily');
    }
}
