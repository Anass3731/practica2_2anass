<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tcoches;
use App\Models\Ttipos_motor;
use Illuminate\Validation\Rules\Numeric;
use Illuminate\Database\Eloquent\Model;

class elmeucontrolador extends Controller
{
    public function f_formulari()
    {
        $tiposMotor = Ttipos_motor::all();
        return view('inserir', compact("tiposMotor")); 
    }

    public function f_insert(Request $request)
    {
        $request->validate([
            'matricula' => 'required|unique:tcoches,matricula',
            'marca'     => 'required',
            'modelo'    => 'required',
            'anyo'      => 'required|numeric',
            'color'     => 'required'
        ], [
            'matricula.required' => "Debes introducir una matrícula",
            'matricula.unique'   => "La matrícula ya existe",
            'marca.required'     => "Debes introducir la marca",
            'modelo.required'    => "Debes introducir el modelo del vehículo",
            'anyo.required'      => "Debes introducir el año del vehículo",
            'anyo.numeric'       => "Tiene que ser numérico sí o sí",
            'color.required'     => "Debes introducir el color del vehículo",
            
        ]);

        $todo = new Tcoches();
        $todo->matricula       = $request->matricula;
        $todo->marca           = $request->marca;
        $todo->modelo          = $request->modelo;
        $todo->anyo            = $request->anyo;
        $todo->color           = $request->color;
        $todo->ttipos_motor_id = $request->ttipos_motor_id; 

        $todo->save();

        return redirect()->route("datos_insertar")->with('success', '¡¡Coche guardado con éxito!!');
    }

  public function f_listar()
{
    $dades = Tcoches::orderBy('marca', 'asc')->orderBy('modelo', 'asc')->get(); 
    return view('listar', compact('dades'));
}

    public function f_consultardetalle($matricula)
    {
        $dades = Tcoches::where('matricula', $matricula)->get();

        if ($dades->isEmpty()) {
            return redirect()->route('dades_consultar')->with('error', 'No existe la matrícula introducida');
        }

        return view('consultardetalle', compact('dades'));
    }

    public function f_formulari_buscar()
    {
        return view('buscar');
    }

    public function f_buscar(Request $request)
    {
        $request->validate(
            ['algo' => 'required'],
            ['algo.required' => 'Introduce una de estas opciones: Matrícula, Marca, Modelo o Año']
        );

        $busqueda = $request->algo;

        $dades = Tcoches::where('matricula', 'like', "%{$busqueda}%")
                        ->orWhere('marca', 'like', "%{$busqueda}%")
                        ->orWhere('modelo', 'like', "%{$busqueda}%")
                         ->orWhere('anyo', 'like', "%{$busqueda}%")
                          ->orWhere('color', 'like', "%{$busqueda}%")
                        ->paginate(5); 

        return view('buscarresultado', compact('dades', 'busqueda'));
    }

    public function f_borrar()
    {
        $dades = Tcoches::orderBy('marca', 'asc')->orderBy('modelo', 'asc')->get();
        return view('borrar', compact('dades'));
    }

    public function f_borrarfila($matricula)
    {
        $coche = Tcoches::where('matricula', $matricula)->first();

        if (!$coche) {
            return redirect()->route('datos_borrar')->with('error', "No existe el coche con matrícula $matricula.");
        }

        $coche->delete();
        return redirect()->route('datos_borrar')->with('success', 'Eliminado correctamente');
    }

    public function f_modificar()
    {
        $dades = Tcoches::orderBy('marca', 'asc')->orderBy('modelo', 'asc')->get();
        return view('modificar', compact('dades'));
    }

    public function f_modificarfila($matricula)
    {
        $fila = Tcoches::where('matricula', $matricula)->get();

        if ($fila->isEmpty()) {
            return redirect()->route('datos_modificar')->with('error', "No existe el coche con matrícula $matricula para modificar.");
        }

        return view('modificarfila', compact('fila'));
    }

    public function f_actualimodificarfila(Request $request, Tcoches $fila)
    {
        $request->validate([
            'marca'  => 'required',
            'modelo' => 'required',
            'anyo'   => 'required|numeric',
            'color'  => 'required'
        ], [
            'marca.required'  => "Debes introducir la marca",
            'modelo.required' => "Debes introducir el modelo del vehículo",
            'anyo.required'   => 'Debes introducir el año del vehículo',
            'anyo.numeric'    => "Tiene que ser numérico sí o sí",
            'color.required'  => "Debes introducir el color del coche"
        ]);

        $fila->matricula = $request->matricula;
        $fila->marca     = $request->marca;
        $fila->modelo    = $request->modelo;
        $fila->anyo      = $request->anyo;
        $fila->color     = $request->color;
        $fila->update();

        return redirect()->route('datos_actualimodificarfila', $fila)->with('success', 'Modificación realizada con éxito');
    }
}