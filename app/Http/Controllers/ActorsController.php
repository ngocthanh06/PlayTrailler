<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\ActorsViewModel;
use App\ViewModels\DetaiActorViewModel;
use Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);
        
        $data['popularActors'] = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/popular?page='.$page)
        ->json()['results'];
     
        $viewModel = new ActorsViewModel($data, $page);

        return view('actors.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['actor'] = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'. $id)
        ->json();
        
        $data['social'] = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'. $id.'/external_ids')
        ->json();

        $data['credits'] = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'. $id.'/combined_credits')
        ->json();

        $viewModel = new DetaiActorViewModel(
            $data
        );

        return view('actors.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
