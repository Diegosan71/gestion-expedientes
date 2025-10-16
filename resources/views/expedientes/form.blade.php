@php
    $isEdit = isset($expediente);
@endphp

<form action="{{ $isEdit ? route('expedientes.update', $expediente) : route('expedientes.store') }}" method="POST">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Número de expediente</label>
        <input type="text" name="numero_expediente" class="form-control"
               value="{{ old('numero_expediente', $expediente->numero_expediente ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Asunto</label>
        <textarea name="asunto" class="form-control">{{ old('asunto', $expediente->asunto ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Fecha Inicio</label>
        <input type="date" name="fecha_inicio" class="form-control"
               value="{{ old('fecha_inicio', $expediente->fecha_inicio ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Estatus</label>
        <select name="id_estatus" class="form-select">
            @foreach(\App\Models\Estatus::all() as $estatus)
                <option value="{{ $estatus->id }}"
                    {{ old('id_estatus', $expediente->id_estatus ?? '') == $estatus->id ? 'selected' : '' }}>
                    {{ $estatus->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">{{ $isEdit ? 'Actualizar' : 'Guardar' }}</button>
</form>
