<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;

class ProductController extends Controller
{
    public static function store($data, $vat_id)
    {
        foreach($data['name'] as $key => $value)
        {
            Product::create([
                'name' => $value,
                'price_netto' => $data['price_netto'][$key],
                'price_brutto' => $data['price_brutto'][$key],
                'vat_rate' => $data['vat_rate'][$key],
                'vat_id' => $vat_id,
                'count' => $data['count'][$key],
                'unit_of_measure' => $data['unit_of_measure'][$key],

            ]);
        }
    }

    public static function append($data)
    {
        foreach($data['local_name'] as $key => $value)
        {
            Product::create([
                'name' => $value,
                'price_netto' => $data['local_price_netto'][$key],
                'price_brutto' => $data['local_price_brutto'][$key],
                'vat_rate' => $data['local_vat_rate'][$key],
                'vat_id' => $data['id'],
                'count' => $data['local_count'][$key],
                'unit_of_measure' => $data['local_unit_of_measure'][$key]

            ]);
        }
    }

    public static function update($data)
    {
        foreach($data['product_id'] as $key => $value)
        {
            Product::where('id', $value)->update([
                'name' => $data['name'][$key],
                'price_netto' => $data['price_netto'][$key],
                'price_brutto' => $data['price_brutto'][$key],
                'vat_rate' => $data['vat_rate'][$key],
                'vat_id' => $data['id'],
                'count' => $data['count'][$key],
                'unit_of_measure' => $data['unit_of_measure'][$key]

            ]);
        }
    }

    public function delete(Request $request)
    {
        $data = $request->all();
        $product = Product::find($data['id'])->delete();
        if($product == true)
        {
            return response()->json(['success'=>'Usunięto produkt.']);
        }else{
            return response()->json(['error'=>'Wystąpił nieoczekiwany błąd podczas próby usunięcia produktu z bazy danych.']);
        }
    }
}
