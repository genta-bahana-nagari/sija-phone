<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Phone;
use App\Models\ShippingType;
use App\Models\Order;
use App\Models\PaymentTypes;
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
        $paymentTypes = PaymentTypes::all();  // Add this line

        return view('checkout.index', [
            'phones' => collect([$phone]),
            'quantities' => [$quantity],
            'shippingTypes' => $shippingTypes,
            'paymentTypes' => $paymentTypes,  // Pass to view
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
        $orderItems = [];

        foreach ($request->phone_ids as $index => $phoneId) {
            $phone = Phone::findOrFail($phoneId);
            $qty = $request->quantities[$index];
            $total += $phone->harga * $qty;
            $orderItems[] = $phone;
        }

        $shipping = ShippingType::findOrFail($request->shipping_type_id);
        $total += $shipping->ongkos;

        // Simpan pesanan
        foreach ($request->phone_ids as $index => $phoneId) {
            Order::create([
                'phone_id' => $phoneId,
                'jumlah_order' => $request->quantities[$index],
                'harga_total' => Phone::findOrFail($phoneId)->harga * $request->quantities[$index] + ($index == 0 ? $shipping->ongkos : 0),
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'status_pesanan' => 'pending',
                'user_id' => auth()->id(),
                'payment_type_id' => $request->payment_method ?? 1,
                'shipping_type_id' => $request->shipping_type_id,
            ]);
        }

        // Hapus dari keranjang hanya produk yang dibeli (jika berasal dari keranjang)
        if ($request->has('source') && $request->source === 'cart') {
            Cart::where('user_id', auth()->id())
                ->whereIn('phone_id', $request->phone_ids)
                ->delete();
        }

        return redirect()->route('orders.history')
            ->with('success', 'Pesanan berhasil dibuat!');
    }


    public function orderHistory()
    {
        $orders = Order::with(['phone.brand', 'shippingType', 'paymentType'])
                        ->where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Pastikan data pesanan dikirim dengan benar ke view
        return view('checkout.order_history', compact('orders'));
    }

    public function show(Order $order)
    {
        // Pastikan hanya user yang memesan yang bisa lihat
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $order->load(['phone.brand', 'shippingType', 'paymentType']);

        return view('checkout.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        // Pastikan user yang membatalkan adalah pemilik pesanan
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Cek apakah status pesanan sudah selesai atau dibatalkan sebelumnya
        if (in_array($order->status_pesanan, ['selesai', 'dibatalkan'])) {
            return redirect()->back()->with('error', 'Pesanan tidak bisa dibatalkan.');
        }

        // Update status pesanan menjadi dibatalkan
        $order->status_pesanan = 'dibatalkan';
        $order->save();

        return redirect()->route('orders.history')->with('success', 'Pesanan berhasil dibatalkan.');
    }

    // Checkout dari keranjang
    public function fromCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('phone')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Keranjang kosong.');
        }

        $shippingTypes = ShippingType::all();
        $paymentTypes = PaymentTypes::all();

        return view('checkout.index', [
            'phones' => $cartItems->pluck('phone'),
            'quantities' => $cartItems->pluck('jumlah'),
            'shippingTypes' => $shippingTypes,
            'paymentTypes' => $paymentTypes,
            'source' => 'cart', // untuk tahu ini dari keranjang
        ]);
    }
}