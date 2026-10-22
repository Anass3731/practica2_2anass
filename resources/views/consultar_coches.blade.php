@extends('plantilla')

@section('titulo', 'Consultar Relaciones')

@section('contingut')
<div class="container mt-4">
    <h2>CONSULTAR TAULES (Relaciones 1:N y N:M)</h2>
    <hr>

    <!-- Sección para mostrar los esquemas E/R -->
    <div class="row mt-5">
        <div class="col-md-6 text-center">
            <h5 class="mb-3">Esquema 1:N (Coches y Tipos de Motor)</h5>
            <div class="card p-3 shadow-sm bg-white rounded">
                <img src="{{ asset('img/1N.png') }}" alt="Esquema ER 1:N" class="img-fluid rounded">
            </div>
        </div>
        
        <div class="col-md-6 text-center">
            <h5 class="mb-3">Esquema N:M (Coches y Extras)</h5>
            <div class="card p-3 shadow-sm bg-white rounded">
                <img src="{{ asset('img/NM.png') }}" alt="Esquema ER N:M" class="img-fluid rounded">
            </div>
        </div>
    </div>


    <table class="table table-bordered table-striped align-middle mt-3">
        <thead class="table-dark">
            <tr>
                <th>Coche (Marca / Modelo)</th>
                <th>Matrícula</th>
                <th>Tipo de Motor (Relación 1:N)</th>
                <th>Extras del Coche (Relación N:M)</th>
            </tr>
        </thead>
        <tbody>
            {{-- Recorremos todos los coches con extras --}}
            @foreach ($cochesConExtras as $coche)
            <tr>
                <td><strong>{{ $coche->marca }} {{ $coche->modelo }}</strong></td>
                <td>{{ $coche->matricula }}</td>
                <td>
                    {{ $coche->tipoMotor->nombre ?? 'Sin motor' }}
                </td>
                <td>
                    @if($coche->extras->count() > 0)
                        <ul class="mb-0 ps-3">
                            @foreach ($coche->extras as $extra)
                                <li>{{ $extra->nombre }} ({{ $extra->precio }}€)</li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-muted fst-italic">Sin extras</span>
                    @endif
                </td>
            </tr>
            @endforeach

            {{-- Recorremos los coches sin extras --}}
            @foreach ($cochesSinExtras as $coche)
            <tr>
                <td><strong>{{ $coche->marca }} {{ $coche->modelo }}</strong></td>
                <td>{{ $coche->matricula }}</td>
                <td>
                    {{ $coche->tipoMotor->nombre ?? 'Sin motor' }}
                </td>
                <td>
                    <span class="text-muted fst-italic">Sin extras</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection