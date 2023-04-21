<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];

    public function loadRecentlyReviewed()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $current = Carbon::now()->timestamp;

        $this->recentlyReviewed = Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, cover.url, first_release_date, platforms.abbreviation, summary, rating, rating_count;
                where platforms = (48,49,130,6)
                & (first_release_date >= '{$before}'
                & first_release_date < '{$current}'
                & rating_count > 5);
                limit 3;"
            )->post(config('services.igdb.endpoint'))
            ->json();
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
