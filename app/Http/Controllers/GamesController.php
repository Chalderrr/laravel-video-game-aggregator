<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
        $current = Carbon::now()->timestamp;

        $popularGames = Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, cover.url, first_release_date, platforms.abbreviation, rating, rating_count;
                where platforms = (48,49,130,6)
                & (first_release_date >= '{$before}'
                & first_release_date < '{$after}');
                limit 20;"
        )->post(config('services.igdb.endpoint'))
            ->json();

        $recentlyReviewed = Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, cover.url, first_release_date, platforms.abbreviation, summary, rating, rating_count;
                where platforms = (48,49,130,6)
                & (first_release_date >= '{$before}'
                & first_release_date < '{$current}'
                & rating_count > 5);
                limit 3;"
            )->post(config('services.igdb.endpoint'))
            ->json();

        $mostAnticipated = Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, cover.url, first_release_date, platforms.abbreviation, rating;
                where platforms = (48,49,130,6)
                & (first_release_date >= '{$before}'
                & first_release_date < '{$afterFourMonths}');
                sort rating desc;
                limit 4;"
            )->post(config('services.igdb.endpoint'))
            ->json();

        $comingSoon = Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields name, cover.url, first_release_date, platforms.abbreviation, rating, rating_count, summary;
                where platforms = (48,49,130,6)
                & (first_release_date >= '{$current}');
                sort rating desc;
                limit 4;"
            )->post(config('services.igdb.endpoint'))
            ->json();

        return view('index', [
            'popularGames' => $popularGames,
            'recentlyReviewed' => $recentlyReviewed,
            'mostAnticipated' => $mostAnticipated,
            'comingSoon' => $comingSoon,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
