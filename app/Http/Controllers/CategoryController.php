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
        $categories = $response->collect('data');

        
        return view('categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $url = config('app.api') . '/category';

        $response = Http::post($url, [
            'nombre' => $request->nombre,
        ]);

        $response = $response['data'];

        return redirect()->route('category.index')->with('alert', $response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $url = config('app.api') . '/category/'.$id;

        $response = Http::put($url, [
            'nombre' => $request->nombre,
        ]);

        $response = $response['data'];

        return redirect()->route('category.index')->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
