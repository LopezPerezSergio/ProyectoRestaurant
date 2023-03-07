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
        $employees = $response->collect('data');

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * * id	contador	nombre	precio	status	tamaño	categoria_id
     */
    public function store(Request $request)
    {
        $url = config('app.api') . '/product/';

        if ($request->has('status')) {
            $response=Http::post($url, [
                'nombre' => $request->nombre,
                'precio' => $request->apellidos,
                'tamaño' => $request->telefono,
                'status' => 1,
                'categoria_id' => $request->sueldo,
            ]);
            return  redirect(route('product.index'));
        }

        $response = Http::post($url, [
            'nombre' => $request->nombre,
                'precio' => $request->apellidos,
                'tamaño' => $request->telefono,
                'status' => 1,
                'categoria_id' => $request->sueldo,
        ]);

        $response = $response['data'];

        /* redirect()->route('admin.products.index')->with('info','El producto se eliminó con éxito'); */
        return  redirect()->route('product.index')->with('alert', $response);
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
