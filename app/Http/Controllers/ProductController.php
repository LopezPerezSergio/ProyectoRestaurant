<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        
        $url = config('app.api') . '/product';
        $response = Http::get($url);
        $products = $response->collect('data');
       
        return view('products.index', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $url = config('app.api') . '/product/';

        $response = Http::post($url, [
            'nombre' => $request->nombre,
            'categoria_id' => $request->apellidos,
            'precio' => $request->precio,
            'status' => $request->has('status') ? 1 : 0,
            'tamaño'=> $request->tamaño,
            'contador' => $request->contador
            
        ]);
        $response = $response['data'];

        return redirect()->route('product.index')->with('alert', $response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
