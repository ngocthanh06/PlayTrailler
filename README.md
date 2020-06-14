<p align="center"><img src="https://ngocthanh06.herokuapp.com/assets/images/ngocthanh06.png" width="400"></p>

## Trailler Movie 

Trailer Movie provides you with the information of the movie you're looking for. The website is based on the Laravel Framework and some libraries such as:

- [API, themoviedb](https://www.themoviedb.org/documentation/api).
- [Tailwindcss](https://tailwindcss.com/).
- [laravel-view-models](https://github.com/spatie/laravel-view-models).
- [Infinite scroll](https://infinite-scroll.com/).
- [Laravel Livewire](https://laravel-livewire.com/).

## Installation

1. Clone the repo and ``` cd ```into it.
2. ``` composer install ```
3. Rename or copy ``` .env.example ``` file to ``` .env ```
4. Set your ``` TMDB_TOKEN ``` in your ``` .env ``` file.  You can get an API key [here](https://www.themoviedb.org/documentation/api). Make sure to use the "API Read Access Token (v4 auth)" from the TMDb dashboard.
5. ``` php artisan key:generate ```
6. ``` php artisan serve ``` or use Laravel Valet or Laravel Homestead
7. Visit ``` localhost:8000 ``` in your browser
