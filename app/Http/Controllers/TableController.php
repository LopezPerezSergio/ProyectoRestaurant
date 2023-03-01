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

        if ($request->has('status')) {
            $response = Http::post($url, [
                'nombre' => $request->nombre,
                'capacidad' => $request->capacidad,
                'status' => 1,
            ]);

            return  redirect(route('table.index'));
        }

        $response = Http::post($url, [
            'nombre' => $request->nombre,
            'capacidad' => $request->capacidad,
            'status' => 0,
        ]);

        return  redirect(route('table.index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TableRequest $request, $id)
    {
        $url = config('app.api') . '/table/'.$id;

        if ($request->has('status')) {
            $response = Http::put($url, [
                'nombre' => $request->nombre,
                'capacidad' => $request->capacidad,
                'status' => 1,
            ]);

            return  redirect(route('table.index'));
        }

        $response = Http::put($url, [
            'nombre' => $request->nombre,
            'capacidad' => $request->capacidad,
            'status' => 0,
        ]);

        return  redirect(route('table.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
