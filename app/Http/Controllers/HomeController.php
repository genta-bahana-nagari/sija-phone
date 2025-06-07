<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Acak rekomendasi
        $phonesForRecommendation = Phone::inRandomOrder()->take(5)->get();

        // Acak produk awal berdasarkan brand
        $phonesForBrands = Phone::inRandomOrder()->take(8)->get();

        return view('home', compact('phonesForRecommendation', 'phonesForBrands'));
    }

    public function loadMore(Request $request)
    {
        // Ambil 8 produk acak untuk load more
        $phonesForMore = Phone::inRandomOrder()->take(8)->get();

        return response()->json($phonesForMore);
    }
}
