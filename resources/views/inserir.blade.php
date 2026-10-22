@extends('plantilla')

@section('titulo', 'Insertar Coche')

@section('contingut')
<style>
    body {
        background: url("{{ asset('img/inserir.jpg') }}") no-repeat center center fixed;
        background-size: cover;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg p-4 bg-white bg-opacity-95 rounded">
        <h2 class="mb-4 text-center">Añadir coche a la venta</h2>
        
        <form action="{{ route('datos_insertar') }}" method="POST">
           
            @csrf
            @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif
         
            <div class="mb-3">
                <label for="matricula" class="form-label">Matrícula</label>
                <input type="text" class="form-control" name="matricula" id="matricula" aria-describedby="helpId" placeholder="0000MMM" value="{{ old('matricula') }}">
                <small id="helpId" class="form-text text-muted">Introduce la matrícula sin espacios ni guiones.</small>
            @error('matricula')
            <h6 class="alert alert-danger mt-1 p-1">{{ $message }}</h6>
            @enderror
            </div>

            <div class="mb-3">
                <label for="marca" class="form-label">Marca del coche</label>
                <input type="text" class="form-control" name="marca" id="marca" placeholder="Audi, SEAT, Volkswagen... " value="{{ old('marca') }}">
                @error('marca')
                    <h6 class="alert alert-danger mt-1 p-1">{{ $message }}</h6>
                @enderror
            </div>

            
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo del coche</label>
                <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Escribe el modelo" value="{{ old('modelo') }}">
                @error('modelo')
                    <h6 class="alert alert-danger mt-1 p-1">{{ $message }}</h6>
                @enderror
            </div>


            <div class="mb-3">
                <label for="anyo" class="form-label">Año del coche</label>
                <input type="number" class="form-control" name="anyo" id="anyo" placeholder="¿De qué año es?" value="{{ old('anyo') }}">
                @error('anyo')
                    <h6 class="alert alert-danger mt-1 p-1">{{ $message }}</h6>
                @enderror
            </div>

            <div class="mb-3">
                <label for="color" class="form-label">Color del coche</label>
                <input type="text" class="form-control" name="color" id="color" placeholder="Escribe el color del coche" value="{{ old('color') }}">
                @error('color')
                    <h6 class="alert alert-danger mt-1 p-1">{{ $message }}</h6>
                @enderror
            </div>

            <div class="mb-3">
                <label for="ttipos_motor_id" class="form-label">Tipo de Motor</label>
                <select name="ttipos_motor_id" id="ttipos_motor_id" class="form-control" required>
                    <option value="">-- Selecciona el tipo de motor --</option>
                    @foreach($tiposMotor as $motor)
                        <option value="{{ $motor->id }}" {{ old('ttipos_motor_id') == $motor->id ? 'selected' : '' }}>
                            {{ $motor->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('ttipos_motor_id')
                    <h6 class="alert alert-danger mt-1 p-1">{{ $message }}</h6>
                @enderror
            </div>
           
            <button type="submit" class="btn btn-primary w-100">Guardar Coche</button>
        </form>

    </div>
</div>
@endsection