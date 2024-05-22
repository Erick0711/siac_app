@can('mostrar-pago')
<div>

    {{-- **** CONTENEDOR **** --}}
    <div class="card">
        <div class="card-body">
            <form wire:submit="created">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" wire:model="obtenerIdCopropietario" required>
                        <label for="">Buscar Copropietario*:</label>
                        <input type="text" class="form-control buscar" placeholder="Buscar..." aria-label="Buscador"
                            wire:model.live="searchCopropietario" @if ($selectedCopropietario) disabled @endif>
                    </div>
                    <div class="col-md-12 rounded p-3 mt-2" id="contenedorBuscador">
                        @if (isset($copropietarios) && strlen($searchCopropietario) > 0)
                            @if ($copropietarios->isNotEmpty())
                                <table class="table table-bordered table-sm table-hover">
                                    <thead class="bg-secondary">
                                        <tr class="text-center">
                                            <th>NOMBRE</th>
                                            <th>CI</th>
                                            <th>APARTAMENTO</th>
                                            <th>ACCION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($copropietarios as $copropietario)
                                            <tr class="copropietario-row"
                                                wire:key="copropietario-{{ $copropietario->id }}"
                                                data-id="{{ $copropietario->id }}"
                                                @if ($selectedCopropietario && $obtenerIdCopropietario != $copropietario->id) style="display: none;" @endif>
                                                <td>{{ $copropietario->nombre }} {{ $copropietario->apellido }}</td>
                                                <td class="text-center">{{ $copropietario->ci }}</td>
                                                <td class="text-center">{{ $copropietario->numero_apartamento }}</td>
                                                <td class="text-center">
                                                    <a wire:click="seleccionarCopropietario({{ $copropietario->id }})"
                                                        class="btn @if ($obtenerIdCopropietario == $copropietario->id) btn-danger @else btn-outline-success @endif btn-sm botones ">
                                                        @if ($obtenerIdCopropietario == $copropietario->id)
                                                            Cancelar
                                                        @else
                                                            Seleccionar
                                                        @endif
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">Ningun dato encontrado.</p>
                            @endif
                        @endif
                    </div>
                                                {{-- 
                                            <div class="col-md-2">
                                                <label for="">SALDO</label>
                                                <input type="number" class="form-control" disabled value="0">
                                            </div>
                            --}}
                    <div class="col-md-6">
                        <label for="">Articulo*:</label>
                        <select class="form-control" wire:model="selectedArticulo" @if ($pagoDisabled) disabled @endif
                        @if (!isset($deudas) && empty($deudas)) required @endif wire:change="guardarSeleccion">
                        <option value="">SELECCIONAR</option>
                        @foreach ($articulos as $articulo)
                            <option value="{{ $articulo->id }}">{{ $articulo->descripcion }} - {{ $articulo->sigla }}</option>
                        @endforeach
                    </select>
                
                    </div>
                    <div class="col-md-6">
                        <label for="">Tipo pago*:</label>
                        <select class="form-control" @if ($pagoDisabled) disabled @endif wire:model="tipopago" required>
                            <option value="">SELECCIONAR</option>
                            @foreach ($tipopagos as $tipopago)
                                <option value="{{ $tipopago->id }}">{{ $tipopago->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="">Total Bs:</label>
                        <input type="number" class="form-control" disabled placeholder="Total a pagar.."
                            value="{{ $totalPago }}">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="">Efectivo*:</label>
                        <input type="number" wire:model.live="efectivo" class="form-control" min="1" placeholder="..." @if ($pagoDisabled) disabled @endif required required>
                    </div>
                    <div class="col-md-12 mt-4">
                        <h3 class="fw-bold font-italic text-center">DETALLE PAGO</h2>
                            <table class="table table-sm table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">ARTICULO</th>
                                        <th class="text-center">MONTO</th>
                                        <th class="text-center">ACCION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($deudas) > 0)
                                        <tr>
                                            <td class="text-center" colspan="4">ARTICULO DEUDA</td>
                                        </tr>
                                    @endif
                                    @foreach ($deudas as $index => $deuda)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $deuda->descripcion }}</td>
                                            <td class="text-center">{{ $deuda->debe }}</td>
                                            <td>
                                                <input type="checkbox"
                                                    wire:change.live="selectedDeudas({{ $deuda->debe }}, {{ $deuda->id_pago }},$event.target.checked)"
                                                    class="form-control form-control-xs" />
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($articulosPagos) > 0)
                                        <tr>
                                            <td class="text-center" colspan="4">ARTICULO PAGO</td>
                                        </tr>
                                    @endif
                                    @foreach ($articulosPagos as $index => $articulosPago)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $articulosPago->descripcion }}</td>
                                            <td class="text-center">{{ $articulosPago->monto }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-danger btn-sm" wire:click="eliminarArticulo({{ $articulosPago->id }})"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
                @if ($efectivo == $totalPago && $efectivo > 0)
                    <div class="row d-flex justify-content-end mt-4">
                        <div class="col-md-12">
                            <x-button class="btn-success btn-block">Guardar Pago</x-button>
                        </div>
                    </div>
                @endif
            </form>

        </div>
    </div>

</div>
@endcan

