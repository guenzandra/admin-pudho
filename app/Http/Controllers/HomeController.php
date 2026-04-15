<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;

class HomeController extends Controller
{
    public function index()
    {
        $latestNews = NewsArticle::orderBy('date', 'desc')->take(4)->get();

        return view('index', compact('latestNews'));
    }
}