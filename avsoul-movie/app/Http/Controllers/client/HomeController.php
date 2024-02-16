<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class HomeController extends Controller
{
    //
    public function Index()
    {
        $movies = Movie::where('status', 1)->get();
        $data = [
            'movies' => $movies
        ];
        return view('client.home.index', $data);
    }
}