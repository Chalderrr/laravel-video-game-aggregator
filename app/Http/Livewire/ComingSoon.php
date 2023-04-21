<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ComingSoon extends Component
{

    public $comingSoon = [];

    public function loadComingSoon()
    {
        $current = Carbon::now()->timestamp;

        $this->comingSoon = Cache::remember('coming-soon', 7, function () use ($current) {

            return Http::withHeaders(config('services.igdb.headers'))
                ->withBody(
                    "fields name, cover.url, first_release_date, platforms.abbreviation, rating, rating_count, summary;
                where platforms = (48,49,130,6)
                & (first_release_date >= '{$current}');
                sort rating desc;
                limit 4;"
                )->post(config('services.igdb.endpoint'))
                ->json();

        });
    }

    public function render()
    {
        return view('livewire.coming-soon');
    }
}
