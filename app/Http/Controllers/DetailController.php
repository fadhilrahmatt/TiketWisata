<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TourPackage;

class DetailController extends Controller
{
    public function index(Request $request, $slug)
    {
        $item = TourPackage::with(['galleries'])
                    ->where('slug', $slug)
                    ->firstOrFail();
        return view('pages.details',[
            'item' => $item
        ]);
    }
}
