<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // HomeController.php
    public function index(Request $request)
    {
        // Mengambil 5 data pertama untuk rekomendasi
        $phonesForRecommendation = Phone::take(5)->get();

        // Mengambil 8 produk pertama untuk section produk berdasarkan merek
        $phonesForBrands = Phone::take(8)->get();

        return view('home', compact('phonesForRecommendation', 'phonesForBrands'));
    }

    public function loadMore(Request $request)
    {
        // Ambil produk lebih banyak (misalnya 8 lagi)
        $phonesForMore = Phone::skip(8)->take(8)->get();

        return response()->json($phonesForMore);
    }
}
