<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = config('app.api') . '/rol';
        
        $response = Http::get($url);
        $roles = $response->collect('data');

        return view('rol.index' , compact('roles'));
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $url = config('app.api') . '/rol/';

        $response = Http::post($url, [
            'nombre' => $request->nombre,
        ]);
        
        $response = $response['data'];
        session()->flash('alert-rol', $response);

        return redirect()->route('rol.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $url = config('app.api') . '/rol/'.$id;

        $response = Http::put($url, [
            'nombre' => $request->nombre,
        ]);

        $response = $response['data'];
        session()->flash('alert-rol', $response);
        
        return redirect()->route('rol.index');
    }

    /**
     * Remove the specified resource from storage.
     * PENDIENTE JEJEJE :)
     */
    public function destroy(Request $request, string $id)
    {
        $url = config('app.api') . '/rol/'.$id; 
    }
}
