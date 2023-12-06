<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];

    public function loadRecentlyReviewed()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $current = Carbon::now()->timestamp;

//        $this->recentlyReviewed = Cache::remember('most-anticipated', 7, function () use ($before, $current) {
//            return Http::withHeaders(config('services.igdb.headers'))
//                ->withBody(
//                    "fields name, cover.url, first_release_date, platforms.abbreviation, summary, rating, rating_count;
//                where platforms = (48,49,130,6)
//                & (first_release_date >= '{$before}'
//                & first_release_date < '{$current}'
//                & rating_count > 5);
//                limit 3;"
//                )->post(config('services.igdb.endpoint'))
//                ->json();
//        });
        $recentlyReviewedUnformatted = Cache::remember('most-anticipated', 7, function () use ($before, $current) {
            return Http::withHeaders(config('services.igdb.headers'))
                ->withBody(
                    "fields name, cover.url, first_release_date, platforms.abbreviation, summary, rating, rating_count;
                where platforms = (48,49,130,6)
                & (first_release_date >= '{$before}'
                & first_release_date < '{$current}'
                & rating_count > 5);
                limit 3;"
                )->post(config('services.igdb.endpoint'))
                ->json();
        });

        $this->recentlyReviewed = $this->formatForView($recentlyReviewedUnformatted);

    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }

    public function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' =>  array_key_exists( 'cover', $game ) ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : '',
                'rating' => isset($game['rating']) ? round($game['rating']).'%' : null,
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->filter()->implode(', ')
            ])->toArray();
        });
    }
}
