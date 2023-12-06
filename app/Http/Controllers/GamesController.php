<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index', []);
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
    public function show($slug)
    {
        $game = Http::withHeaders(config('services.igdb.headers'))
            ->withBody(
                "fields *, cover.url, first_release_date, popularity, platforms.abbreviation, rating,
                    slug, involved_companies.company.name, genres.name, aggregated_rating, summary, websites.*, videos.*, screenshots.*, similar_games.cover.url, similar_games.name, similar_games.rating,similar_games.platforms.abbreviation, similar_games.slug;
                    where slug=\"{$slug}\";
                "
            )->post(config('services.igdb.endpoint'))
            ->json();

        abort_if( ! $game, 404 );

        return view('show', [
            'game' => $this->formatGameForView($game[0]),
        ]);
    }

    private function formatGameForView($game)
    {
     $temp = collect($game)->merge([
         'coverImageUrl' =>  isset( $game['cover'] ) ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : '',
         'genres' => collect($game['genres'])->pluck('name')->implode(', '),
         'involvedCompanies' => isset($game['involved_companies']) ? $game['involved_companies'][0]['company']['name'] : '',
         'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
         'memberRating' => isset($game['rating']) ? round($game['rating']).'%' : '0%',
         'criticRating' => isset($game['aggregated_rating']) ? round($game['aggregated_rating']).'%' : '0%',
         'trailer' => isset($game['videos']) ? 'https://youtube.com/watch/' . $game['videos'][0]['video_id'] : '',
         'screenshots' => collect($game['screenshots'])->map(function ($screenshot) {
             return [
                 'big' =>  Str::replaceFirst('thumb', 'screenshot_big', $screenshot['url']),
                 'huge' =>  Str::replaceFirst('thumb', 'screenshot_huge', $screenshot['url'])
            ];
         })->take(9)
     ]);

     return $temp;
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
