<?php

namespace App\Http\Controllers;
use App\Http\Requests\EmpleadosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = config('app.api') . '/employee';

        $response = Http::get($url);
        $employees = $response->collect('data');

        return view('employees.index', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpleadosRequest $request)
    {
        $url = config('app.api') . '/employee/';
        //Validacion de los campos
       // $request->validate($this->rules);
        $response = Http::post($url, [
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'status' => $request->has('status') ? 1 : 0,
            'codigoAcceso' => $request->codigoAcceso,
            'sueldo' => $request->sueldo
        ]);

        $response = $response['data'];
        return redirect()->route('employee.index')->with('alert', $response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $url = config('app.api') . '/employee/' . $id;

        $response = Http::put($url, [
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'status' => $request->has('status') ? 1 : 0,
            'codigoAcceso' => $request->codigoAcceso,
            'sueldo' => $request->sueldo
        ]);
        $response = $response['data'];

        return  redirect()->route('employee.index')->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
