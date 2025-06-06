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

        // Filter: pencarian
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('tipe', 'like', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        // Filter: status stok
        if ($request->filled('status_stok') && $request->status_stok !== 'all') {
            $query->where('status_stok', (int) $request->status_stok);
        }

        // Filter: brand
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        $phones = $query->latest()->paginate(12)->withQueryString();

        $brands = Brand::orderBy('brand')->get();

        return view('see-all', compact('phones', 'brands'));
    }
}
