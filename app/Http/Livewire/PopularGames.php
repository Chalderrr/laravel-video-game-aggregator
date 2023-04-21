<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PopularGames extends Component
{

    public $popularGames = [];

    public function loadPopularGames()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;

        $this->popularGames = Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, cover.url, first_release_date, platforms.abbreviation, rating, rating_count;
                where platforms = (48,49,130,6)
                & (first_release_date >= '{$before}'
                & first_release_date < '{$after}');
                limit 20;"
            )->post(config('services.igdb.endpoint'))
            ->json();
    }

    public function render()
    {
        return view('livewire.popular-games');
    }
}