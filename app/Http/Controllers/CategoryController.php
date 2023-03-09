<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = config('app.api') . '/category';
        $response = Http::get($url);
        $category = $response->collect('data');
       
        return view('category.index', compact('category'));
    }



    public function store(Request $request)
    {
       // return $request;
        //Validacion de los campos
       // $request->validate($this->rules);
        $url = config('app.api') . '/category/';
        $response = Http::post($url, [
            'nombre' => $request->nombre
        ]);

        $response = $response['data'];
        return redirect()->route('category.index')->with('alert', $response);
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
