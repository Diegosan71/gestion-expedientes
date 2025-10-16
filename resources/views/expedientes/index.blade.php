@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Gestión de Expedientes</h1>

    {{-- Mensajes de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Filtros --}}
    <form method="GET" action="{{ route('expedientes.index') }}" class="mb-4 row g-3">
        <div class="col-md-3">
            <input type="text" name="busqueda" class="form-control" placeholder="Número o asunto" value="{{ request('busqueda') }}">
        </div>
        <div class="col-md-2">
            <select name="estatus" class="form-select">
                <option value="">Todos los estados</option>
                @foreach(App\Models\Estatus::all() as $estatus)
                    <option value="{{ $estatus->id }}" {{ request('estatus') == $estatus->id ? 'selected' : '' }}>
                        {{ $estatus->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="fecha_inicio_desde" class="form-control" value="{{ request('fecha_inicio_desde') }}">
        </div>
        <div class="col-md-2">
            <input type="date" name="fecha_inicio_hasta" class="form-control" value="{{ request('fecha_inicio_hasta') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('expedientes.index') }}" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <a href="{{ route('expedientes.create') }}" class="btn btn-success mb-3">Nuevo Expediente</a>

    {{-- Tabla de expedientes --}}
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Número</th>
                <th>Asunto</th>
                <th>Fecha Inicio</th>
                <th>Estado</th>
                <th>Registrado por</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($expedientes as $expediente)
                <tr @if($expediente->deleted_at) class="table-secondary" @endif>
                    <td>{{ $expediente->numero_expediente }}</td>
                    <td>{{ $expediente->asunto }}</td>
                    <td>{{ $expediente->fecha_inicio->format('d/m/Y') }}</td>
                    <td>{{ $expediente->estatus->nombre }}</td>
                    <td>{{ $expediente->user->name ?? 'Sin usuario' }}</td>
                    <td>
                        @can('update', $expediente)
                            <a href="{{ route('expedientes.edit', $expediente) }}" class="btn btn-sm btn-primary">Editar</a>
                        @endcan

                        @if(!$expediente->deleted_at)
                            @can('delete', $expediente)
                                <form action="{{ route('expedientes.destroy', $expediente) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            @endcan
                        @else
                            @can('delete', $expediente)
                                <form action="{{ route('expedientes.restore', $expediente->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-warning">Restaurar</button>
                                </form>
                            @endcan
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No se encontraron expedientes.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $expedientes->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
