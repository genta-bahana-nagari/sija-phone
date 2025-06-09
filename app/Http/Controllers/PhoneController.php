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

        // Filter: Status stok
        if ($request->filled('status_stok') && $request->status_stok !== 'all') {
            $query->where('status_stok', (int) $request->status_stok);
        }

        // Filter: Brand
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        // Filter: Harga Minimum
        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->harga_min);
        }

        // Filter: Harga Maksimum
        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }

        // Sort: Harga Terendah/Tertinggi
        if ($request->sort === 'harga_terendah') {
            $query->orderBy('harga', 'asc');
        } elseif ($request->sort === 'harga_tertinggi') {
            $query->orderBy('harga', 'desc');
        } else {
            // Default: Random
            $query->inRandomOrder();
        }

        // Pagination
        $phones = $query->paginate(12)->withQueryString();

        // Semua brand untuk dropdown
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
