<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::with('product')->orderBy('created_at', 'desc')->get();
        return view('admin.reviews.index', compact('reviews'));
    }
} 