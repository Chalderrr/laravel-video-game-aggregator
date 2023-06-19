<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PopularGames extends Component
{

    public $popularGames = [];

    public function loadPopularGames()
    {
        $before = Carbon::now()->subMonths(8)->timestamp;
        $after = Carbon::now()->addMonths(5)->timestamp;

        $test = Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, slug, cover.url, first_release_date, platforms.abbreviation, rating, rating_count;
                    where platforms = (48,49,130,6)
                    & (first_release_date >= '{$before}'
                    & first_release_date < '{$after}');
                    limit 20;"
            )->post(config('services.igdb.endpoint'))
            ->json();

        dd($test);

        $this->popularGames = Cache::remember('popular-games', 7, function () use ($before, $after) {
            return Http::withHeaders(config('services.igdb.headers'))
                ->withBody(
                    "fields name, slug, cover.url, first_release_date, platforms.abbreviation, rating, rating_count;
                    where platforms = (48,49,130,6)
                    & (first_release_date >= '{$before}'
                    & first_release_date < '{$after}');
                    limit 20;"
                )->post(config('services.igdb.endpoint'))
                ->json();
        });

        dump($this->popularGames);
    }

    public function render()
    {
        return view('livewire.popular-games');
    }
}
