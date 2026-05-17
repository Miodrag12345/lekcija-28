<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $products = Cache::get('products', []);
        return view('home', compact('products'));
    }
}
