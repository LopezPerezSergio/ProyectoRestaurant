<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = config('app.api') . '/table';

        $response = Http::get($url);
        $tables = $response->collect('data');

        return view('tables.index', compact('tables'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TableRequest $request)
    {
        $url = config('app.api') . '/table/';

        $response = Http::post($url, [
            'nombre' => $request->nombre,
            'capacidad' => $request->capacidad,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('table.index')->with('alertTable', $response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TableRequest $request, $id)
    {
        $url = config('app.api') . '/table/'.$id;

        $response = Http::put($url, [
            'nombre' => $request->nombre,
            'capacidad' => $request->capacidad,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('table.index')->with('alertTable', $response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
