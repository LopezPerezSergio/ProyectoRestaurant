<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
        //obtengo los datos de categoria
        $url = config('app.api') . '/category/'.$request->categoria;
        $response = Http::get($url);
        
        $category = $response->collect('data');
        $category = ['id' => $category['id'], 'nombre' =>  $category['nombre']];  

        //Subo la imagen al servidor
        $image = $request->file('url_img')->store('public/products'); //guardo el archivo
        $url_img = Storage::disk('local')->put('products', $request->file('url_img'));// genero la Url -> products/nomnbre-de-producto

        //Mando los datos que se guardara
        $url = config('app.api') . '/product';
        
        $response = Http::post($url, [
            'nombre' => $request->nombre,
            'tamanio' => $request->tamanio,
            'precio' => $request->precio,
            'status' => $request->has('status') ? 1 : 0,
            'contador' => 0,
            'url_img' => $url_img,
            'categoria' => $category
        ]);

        $response = $response['data'];

        //Cambiar el mensaje cunado se programe el data
        session()->flash('alert-product', 'Producto agregada');

        return redirect()->route('product.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $url = config('app.api') . '/category/'.$request->categoria;
        $response = Http::get($url);
        
        $category = $response->collect('data');
        $category = ['id' => $category['id'], 'nombre' =>  $category['nombre']];  

        $url = config('app.api') . '/product/'.$id;
        
        $response = Http::post($url, [
            'nombre' => $request->nombre,
            'tamaño' => $request->tamaño,
            'precio' => $request->precio,
            'status' => $request->has('status') ? 1 : 0,
            'contador' => 0,
            'categoria' => $category
        ]);

        $response = $response['data'];

        //Cambiar el mensaje cunado se programe el data
        session()->flash('alert-product', 'Producto agregada');

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
