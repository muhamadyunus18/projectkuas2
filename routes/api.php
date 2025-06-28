<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('products/{id}/variations', [ProductController::class, 'getVariations']);

Route::post('/products', function (Request $request) {
    // Implementation of creating a new product
});

Route::put('/products/{id}', function (Request $request, $id) {
    // Implementation of updating an existing product
});

Route::delete('/products/{id}', function (Request $request, $id) {
    // Implementation of deleting a product
});

Route::post('/products/{id}/review', [ProductController::class, 'addReview']);
Route::get('/products/{id}/reviews', [ProductController::class, 'getReviews']); 