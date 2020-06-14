@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
          @if($movie['poster_path'])
              <img src="{{$movie['poster_path']}}" alt="parasite" class="md:w-96">
          @else 
              <img class="md:w-96" src="https://via.placeholder.com/50x75" alt="poster">
          @endif
          <div class="md:ml-24">
            <h2 class="text-4xl font-semibold">{{$movie['title']}}</h2> 
            <div class="flex flex-wrap items-center text-sm text-gray-400">
              <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
              <span class="ml-1">{{$movie['vote_average']}}</span>
              <span class="mx-2">|</span>
              <span>{{$movie['release_date']}}</span>
              <span class="mx-2">|</span>
              <span>
                {{$movie['genres']}}
              </span>
            </div>

            <p class="text-gray-300 mt-8">
              {{$movie['overview']}}
            </p>

            <div class="mt-12">
              <h4 class="text-white font-semibold">Featured Cast</h4>
              <div class="flex mt-4">
                @foreach($movie['crew'] as $item)
                  <div class="mr-8">
                    <div>{{$item['name']}}</div>
                    <div class="text-sm text-gray-400">{{$item['job']}}</div>
                  </div>
                @endforeach
              </div>
            </div>
            <div x-data="{isOpen : false}">
              @if(count($movie['videos']['results'])>0)
                <div class="mt-12">
                  <button 
                          @click = "isOpen = true"
                          href="https://youtube.com/watch?v={{$movie['videos']['results'][0]['key']}}" 
                          class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150" >
                    <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                    <span class="ml-2">Play Trailer</span>
                  </button>
                </div> 
              @endif
                {{-- show video --}}
              <div x-show.transaction.opacity="isOpen" 
                   style="background-color: rgba(0, 0, 0, .5);" 
                   class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                          <div class="bg-gray-900 rounded">
                              <div class="flex justify-end pr-4 pt-2">
                                  <button
                                      @click="isOpen = false"
                                      @keydown.escape.window="isOpen = false"
                                      class="text-3xl leading-none hover:text-gray-300">&times;
                                  </button>
                              </div>
                              <div class="modal-body px-8 py-8">
                                  <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                      <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                  </div>
                              </div>
                        </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    {{-- movie info --}}
    <div class="movie-cast border-b border-gray-800">
      <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Cast</h2>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
          @foreach($movie['cast'] as $item)
            <div class="mt-8">
              <a href="{{route('actors.show', $item['id'])}}">
                @if($item['profile_path'])
                    <img src="{{'https://image.tmdb.org/t/p/w300/' . $item['profile_path']}}" alt="actor1" class="hover:opacity-75 transition ease-in-out duration-150">
                @else 
                    <img src="https://via.placeholder.com/50x75" alt="actor1" class="hover:opacity-75 transition ease-in-out duration-150">
                @endif
              </a>
              <div class="mt-2">
                <a href="{{route('actors.show', $item['id'])}}" class="text-lg mt-2 hover:text-gray:300">{{$item['name']}}</a>
                
                <div class="text-gray-400 text-sm">
                  {{$item['character']}}
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </div>
    </div>

    {{-- movies-image --}}

    <div class="movie-images border-b border-gray-800" x-data = "{isOpen: false, image: ''}">
      <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

          @foreach ($movie['images'] as $image)
            <div class="mt-8">
              <a @click.prevent="
                  isOpen = true
                  image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                  "
                  href="#">
                <img src="{{'https://image.tmdb.org/t/p/w500/' . $image['file_path']}}" alt="actor1" class="hover:opacity-75 transition ease-in-out duration-150">
              </a>
            </div>
          @endforeach
        </div>

        <div x-show.transaction.opacity="isOpen" 
            style="background-color: rgba(0, 0, 0, .5);" 
            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                  <div class="bg-gray-900 rounded">
                      <div class="flex justify-end pr-4 pt-2">
                          <button
                              @click="isOpen = false"
                              @keydown.escape.window="isOpen = false"
                              class="text-3xl leading-none hover:text-gray-300">&times;
                          </button>
                      </div>
                      <div class="modal-body px-8 py-8">
                          <img :src="image" alt="poster">
                      </div>
                </div>
            </div>
        </div>

      </div>
    </div>

@endsection
