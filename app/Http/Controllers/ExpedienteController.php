<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use App\Services\ExpedienteService;
use Illuminate\Http\Request;


class ExpedienteController extends Controller
{
    protected $service;

    

    public function __construct(ExpedienteService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    /**
     * Listado de expedientes con filtros y paginación
     */
    public function index(Request $request)
    {
        $filtros = $request->only(['estatus', 'fecha_inicio_desde', 'fecha_inicio_hasta', 'busqueda']);
        $expedientes = $this->service->listar($filtros, auth()->user());
        return view('expedientes.index', compact('expedientes'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('expedientes.create');
    }

    /**
     * Guardar nuevo expediente
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'numero_expediente' => 'required|unique:expedientes,numero_expediente',
            'asunto' => 'required|string',
            'fecha_inicio' => 'required|date',
            'id_estatus' => 'required|exists:estatus,id',
        ]);

        $this->service->crear($data, auth()->user());
        return redirect()->route('expedientes.index')->with('success', 'Expediente creado');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Expediente $expediente)
    {
        $this->authorize('update', $expediente);
        return view('expedientes.edit', compact('expediente'));
    }

    /**
     * Actualizar expediente
     */
    public function update(Request $request, Expediente $expediente)
    {
        $this->authorize('update', $expediente);

        $data = $request->validate([
            'numero_expediente' => 'required|unique:expedientes,numero_expediente,' . $expediente->id,
            'asunto' => 'required|string',
            'fecha_inicio' => 'required|date',
            'id_estatus' => 'required|exists:estatus,id',
        ]);

        $this->service->actualizar($expediente, $data);
        return redirect()->route('expedientes.index')->with('success', 'Expediente actualizado');
    }

    /**
     * Eliminar expediente (soft delete)
     */
    public function destroy(Expediente $expediente)
    {
        $this->authorize('delete', $expediente);
        $this->service->eliminar($expediente);
        return redirect()->route('expedientes.index')->with('success', 'Expediente eliminado');
    }

    /**
     * Restaurar expediente eliminado (solo admin)
     */
    public function restore($id)
{
    $expediente = Expediente::withTrashed()->findOrFail($id);

    // Verifica permisos si usas policies
    $this->authorize('restore', $expediente);

    $expediente->restore();

    return redirect()->route('expedientes.index')
                     ->with('success', 'Expediente restaurado correctamente.');
}
}
