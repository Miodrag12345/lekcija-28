<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function create(Request $request)
    {
        $products = Cache::get('products', []);

        $products[] = [
            'name'  => $request->name,
            'price' => $request->price,
            'sku'   => $request->sku,
        ];

        Cache::put('products', $products);

        return redirect('/');
    }

    public function flush()
    {
        Cache::forget('products');
        return redirect('/');
    }
}
