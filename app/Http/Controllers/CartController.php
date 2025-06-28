<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Tampilkan isi keranjang
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // Tambah produk ke keranjang
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        // Jika produk sudah ada di keranjang, tambah qty
        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] += 1;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
                'image' => $product->image,
            ];
        }

        session(['cart' => $cart]);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Hapus produk dari keranjang
    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
    }
} 