<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('phone.brand')->get();
        return view('keranjang', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'phone_id' => 'required|exists:phones,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->where('phone_id', $validated['phone_id'])
            ->first();

        if ($cart) {
            $cart->jumlah += $validated['quantity'];
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'phone_id' => $validated['phone_id'],
                'jumlah' => $validated['quantity'],
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function remove($id)
    {
        $item = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Item dihapus dari keranjang.');
    }
}