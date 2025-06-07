<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\PaymentTypes;
use App\Models\Phone;
use App\Models\ShippingType;
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
        if (!is_numeric($id)) {
            return redirect()->route('cart.index')->with('error', 'ID tidak valid.');
        }

        $item = Cart::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$item) {
            return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan.');
        }

        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function checkoutSelected(Request $request)
    {
        $selectedIds = $request->input('selected_items');

        if (!$selectedIds) {
            return back()->with('error', 'Tidak ada item yang dipilih untuk checkout.');
        }

        $selectedItems = Cart::whereIn('id', $selectedIds)
            ->with('phone.brand')
            ->where('user_id', Auth::id())
            ->get();

        $phones = $selectedItems->pluck('phone');
        $quantities = $selectedItems->pluck('jumlah')->toArray();

        // Ambil metode pengiriman dan pembayaran dari database (atau model terkait)
        $shippingTypes = ShippingType::all(); // Pastikan model ini ada
        $paymentTypes = PaymentTypes::all();   // Pastikan model ini juga ada

        return view('checkout.index', [
            'phones' => $phones,
            'quantities' => $quantities,
            'shippingTypes' => $shippingTypes,
            'paymentTypes' => $paymentTypes,
            'source' => 'cart',
        ]);
    }
}