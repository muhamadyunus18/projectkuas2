<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::where('is_featured', true)->orderBy('created_at', 'desc')->get();
        return view('home', compact('featured'));
    }

    public function menu()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        $bestsellers = Product::where('is_bestseller', true)->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        return view('menu', compact('products', 'bestsellers', 'user'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
} 