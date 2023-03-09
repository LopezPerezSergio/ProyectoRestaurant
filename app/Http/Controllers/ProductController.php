<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        
        $url = config('app.api') . '/product';
        //$url = config('app.api') . '/category';
        $response = Http::get($url);
        $products = $response->collect('data');
        $category = $response->collect('data');
        return view('products.index', compact('products','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   return $request;
        $url = config('app.api') . '/product/';
        
        $response = Http::post($url, [
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'precio' => $request->precio,
            'status' => $request->has('status') ? 1 : 0,
            'tamanio'=> $request->tamanio,
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
