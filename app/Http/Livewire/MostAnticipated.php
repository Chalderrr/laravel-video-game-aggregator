<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MostAnticipated extends Component
{

    public $mostAnticipated = [];

    public function loadMostAnticipated()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;

        $this->mostAnticipated = Cache::remember('most-anticipated', 7, function () use ($before, $afterFourMonths) {
            return Http::withHeaders(config('services.igdb.headers'))
                ->withBody(
                    "fields name, cover.url, first_release_date, platforms.abbreviation, rating;
                    where platforms = (48,49,130,6)
                    & (first_release_date >= '{$before}'
                    & first_release_date < '{$afterFourMonths}');
                    sort rating desc;
                    limit 4;"
                )->post(config('services.igdb.endpoint'))
                ->json();
        });


    }

    public function render()
    {
        return view('livewire.most-anticipated');
    }
}
