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

        if ($request->has('status')) {
            $response=Http::post($url, [
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'status' => 1,
                'sueldo' => $request->sueldo,
                'codigoAcceso' => $request->codigoAcceso,
                

            ]);
            return  redirect(route('employee.index'));
        }

        $response = Http::post($url, [
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'status' => 0,
            'sueldo' => $request->sueldo,
            'codigoAcceso' => $request->codigoAcceso,
        ]);

        $response = $response['data'];

        /* redirect()->route('admin.products.index')->with('info','El producto se eliminó con éxito'); */
        return  redirect()->route('employee.index')->with('alert', $response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $url = config('app.api') . '/employee/' . $id;

        if ($request->has('status')) {
            Http::put($url, [
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'status' => 1,
                'sueldo' => $request->sueldo,
                'codigoAcceso' => $request->codigoAcceso,
            ]);

            return  redirect(route('employee.index'));
        }

        $response = Http::put($url, [
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'status' => 0,
            'sueldo' => $request->sueldo,
            'codigoAcceso' => $request->codigoAcceso,
        ]);

        return  redirect(route('employee.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
