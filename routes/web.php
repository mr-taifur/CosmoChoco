<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Home page
Route::get('/', function () {
    return view('home');
});

// Cart page (for later)
Route::get('/cart', function () {
    return view('cart');
});

// Products page with category handling
Route::get('/products', function (Request $request) {
    $category = $request->query('category'); // get ?category=value

    // Choose the view based on category
    switch ($category) {
        case 'skincare':
            return view('skincare');
        case 'makeup':
            return view('makeup');
        case 'chocolates':
            return view('chocolates');
        case 'perfumes':
            return view('perfumes');
        default:
            return view('products'); // default all products page
    }
})->name('products');
