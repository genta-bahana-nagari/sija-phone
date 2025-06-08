<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function seeAll(Request $request)
    {
        $query = Phone::query();

        // Filter: Pencarian keyword (tipe/deskripsi)
        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('tipe', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Filter: Status stok (jika bukan 'all')
        if ($request->filled('status_stok') && $request->status_stok !== 'all') {
            $query->where('status_stok', (int) $request->status_stok);
        }

        // Filter: Brand
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        // Urutkan secara acak dan paginate
        $phones = $query->inRandomOrder()->paginate(12)->withQueryString();

        // Ambil semua brand untuk filter dropdown
        $brands = Brand::orderBy('brand')->get();

        return view('see-all', compact('phones', 'brands'));
    }

    // Untuk tambahan section
    public function show($id)
    {
        // Mengambil 5 data pertama untuk rekomendasi
        // $phonesForRecommendation = Phone::take(5)->get();
        
        // Urutkan secara acak
        $phonesForRecommendation = Phone::inRandomOrder()->take(5)->get();

        $phone = Phone::with('brand')->findOrFail($id);
        return view('phones.show', compact('phone', 'phonesForRecommendation'));
    }
}
