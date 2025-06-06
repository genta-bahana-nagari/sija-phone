<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\ShippingType;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkoutFromProduct(Request $request)
    {
        $request->validate([
            'phone_id' => 'required|exists:phones,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $phone = Phone::findOrFail($request->phone_id);
        $quantity = $request->quantity;
        $shippingTypes = ShippingType::all();

        return view('checkout', [
            'phones' => collect([$phone]),
            'quantities' => [$quantity],
            'shippingTypes' => $shippingTypes,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'shipping_type_id' => 'required|exists:shipping_types,id',
            'phone_ids' => 'required|array',
            'quantities' => 'required|array',
        ]);

        $total = 0;
        foreach ($request->phone_ids as $index => $phoneId) {
            $phone = Phone::findOrFail($phoneId);
            $qty = $request->quantities[$index];
            $total += $phone->harga * $qty;
        }

        $shipping = ShippingType::findOrFail($request->shipping_type_id);
        $total += $shipping->ongkos;

        foreach ($request->phone_ids as $index => $phoneId) {
            Order::create([
                'phone_id' => $phoneId,
                'jumlah_order' => $request->quantities[$index],
                'harga_total' => Phone::findOrFail($phoneId)->harga * $request->quantities[$index] + ($index == 0 ? $shipping->ongkos : 0),
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'status_pesanan' => 'pending',
                'user_id' => Auth::id(),
                'payment_type_id' => 1,
                'shipping_type_id' => $request->shipping_type_id,
            ]);
        }

        return redirect('/')->with('success', 'Pesanan berhasil dibuat!');
    }
}
