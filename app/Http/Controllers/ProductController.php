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
        $url = config('app.api') . '/category';

        $response = Http::get($url);
        $categories = $response->collect('data');

        $url = config('app.api') . '/product';

        $response = Http::get($url);
        $products = $response->collect('data');

        return view('products.index', compact('products','categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request;    
        $url = config('app.api') . '/product/';

        $response = Http::post($url, [
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'status' => $request->has('status') ? 1 : 0,
            'sueldo' => $request->sueldo
        ]);
        $response = $response['data'];

        return redirect()->route('product.index')->with('alert', $response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
