<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    private $rules = [
        'nombre' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'apellidos' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'telefono' => 'required|numeric:/^[0-9]{10}$/',
            'sueldo' => 'required|regex:/^([0-9]{1,3}\.[0-9]{2})$/',
            'codigoAcceso' => 'required|numeric:/^[0-9]{4}$/',

    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = config('app.api') . '/rol';
        $response = Http::get($url);
        $roles = $response->collect('data');

        $url = config('app.api') . '/employee';
        $response = Http::get($url);
        $employees = $response->collect('data');

        return view('employees.index', compact('employees', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);
        //obtener los datos de Rol
        $url = config('app.api') . '/rol/search-id/'.$request->rol;
        $response = Http::get($url);
        
        $rol = $response->collect('data');
        $rol = ['id' => $rol['id'], 'nombre' =>  $rol['nombre']];

        //Guardamos el empleado
        $url = config('app.api') . '/employee/';

        if ($request->has('status')) {
            Http::post($url, [
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'status' => 1,
                'sueldo' => $request->sueldo
            ]);

            return  redirect(route('employee.index'));
        }

        $response = Http::post($url, [
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'status' => $request->has('status') ? 1 : 0,
            'sueldo' => $request->sueldo,
            'codigoAcceso' => $request->codigoAcceso,
            'rol' => $rol /* { id => 1, nombre => 'nombre} */
        ]);
        
        $response = $response['data'];
        
        session()->flash('alert-employee', $response);

        return redirect()->route('employee.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         //obtener los datos de Rol
         $url = config('app.api') . '/rol/search-id/'.$request->rol;
         $response = Http::get($url);
         
         $rol = $response->collect('data');
         $rol = ['id' => $rol['id'], 'nombre' =>  $rol['nombre']];

        //Guardamos el empleado
        $url = config('app.api') . '/employee/' . $id;

        $response = Http::put($url, [
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'status' => $request->has('status') ? 1 : 0,
            'sueldo' => $request->sueldo,
            'codigoAcceso' => $request->codigoAcceso,
            'rol' => $rol
        ]);
        
        $response = $response['data'];
        session()->flash('alert-employee', $response);

        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
