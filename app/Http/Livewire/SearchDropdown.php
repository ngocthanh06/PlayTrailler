<?php

namespace App\Http\Livewire;
use Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {

        $data['search'] = [];

        if(strlen($this->search) >= 2){
            $data['search'] = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
            ->json()['results'];

        }
        
        $data['searchResults'] = collect($data['search'])->take(7);
        
        return view('livewire.search-dropdown', $data);
    }
}
