<?php

namespace LaravelEnso\Core\App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use LaravelEnso\Core\App\Http\Responses\AppState;

class Spa extends Controller
{
    public function __invoke()
    {
        return App::make(AppState::class);
    }
}
