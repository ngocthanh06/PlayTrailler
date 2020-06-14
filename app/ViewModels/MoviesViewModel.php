<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{

    public $popularMovies, $nowPlayingMovies, $genres;

    public function __construct($data)
    {
        $this->popularMovies = $data['popularMovies'];
        $this->nowPlayingMovies = $data['nowPlayingMovies'];
        $this->genres = $data['genres'];
    }

    public function popularMovies(){
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlayingMovies(){
        return $this->formatMovies($this->nowPlayingMovies);
    }

    public function genres(){
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [ $genre['id'] => $genre['name'] ]; 
        });
    }

    private function formatMovies($movie){
        return collect($this->popularMovies)->map(function ($movie){
            $generesFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value){
                return [ $value => $this->genres()->get($value) ]; 
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'],
                'vote_average' => $movie['vote_average']*10 .'%',
                'release_date' => \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $generesFormatted
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres'
            ]);
        });
    }
}
