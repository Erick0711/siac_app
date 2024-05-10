<div>

    {{-- **** CONTENEDOR **** --}}
        <div class="card">
            <div class="card-header">
                <div class="row d-flex justify-content-between">
                    <div class="col-md-1">
                        @can('agregar-periodo')
                            <button class="btn btn-success btn-md" wire:click="$toggle('openModalNew')"><i class="fas fa-plus-square"></i></button>
                        @endcan
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Buscar..." aria-label="buscar" aria-describedby="basic-addon1" wire:model.live="search">
                        </div>
                    </div>
                </div>

            </div>
            @if($periodos->count())
                <div class="card-body">
                    <table class="table table-sm table-bordered table-hover ">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>#</th>
                                <th>PERIODO</th>
                                <th>GESTION</th>
                                @can('funciones-periodo')
                                    <th>ACCIONES</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periodos as $periodo)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{$apartamento->periodo}}</td>
                                    <td>{{$apartamento->gestion}}</td>
                                    @can('funciones-periodo')
                                        <td class="text-center">
                                            @can('editar-periodo')
                                                <button class="btn btn-warning btn-sm" wire:click="edit({{ $periodo->id }})"><i class="fas fa-pencil-alt"></i></button>
                                            @endcan
                                            @can('eliminar-periodo')
                                                @if ($periodo->estado == 1)
                                                    <button class="btn btn-danger btn-sm" wire:click="$dispatch('confirmDelete', {{ $periodo->id }})"><i class="fas fa-trash"></i></button>
                                                @else
                                                    <button class="btn btn-primary btn-sm" wire:click="$dispatch('confirmDelete', {{ $periodo->id }})"><i class="fas fa-history"></i></button>
                                                @endif
                                            @endcan
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$periodos->links()}}
                </div>
            @else
                <div class="card-body">
                    <strong class="text-center">No hay registros</strong>
                </div>
            @endif
        </div>


    {{-- * MODAL --}}
    @if ($openModalNew)
        <!-- Modal -->
        <div class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: block" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Encabezado del Modal -->
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">NUEVO PERIODO</h4>
                        <button type="button" class=" btn btn-danger btn-sm" data-dismiss="modal" wire:click="closeModal">×</button>
                    </div>
        
                    <!-- Contenido del Modal -->
                    <div class="modal-body">
                        <form wire:submit="created">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">PERIODO*:</label>
                                    <input class="form-control" type="text" wire:model="periodo.nombre" required>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="">GESTION*:</label>
                                    <select class="form-control" mode:model="periodo.id_gestion">
                                        <option value=""></option>
                                        @foreach ($gestiones as $gestion)
                                            <option value="{{$gestion->id}}">{{$gestion->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-end mt-4">
                                <x-button class="btn-success btn-sm">Guardar</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif


    
    {{-- * MODAL --}}
    @if ($openModalEdit)
        <!-- Modal -->
        <div class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: block" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Encabezado del Modal -->
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">EDITAR PERIODO</h4>
                        <button type="button" class=" btn btn-danger btn-sm" data-dismiss="modal" wire:click="closeModal">×</button>
                    </div>
        
                    <!-- Contenido del Modal -->
                    <div class="modal-body">
                        <form wire:submit="update">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">PERIODO*:</label>
                                    <input class="form-control" type="text" wire:model="periodo.nombre" required>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="">GESTION*:</label>
                                    <select class="form-control" mode:model="periodo.id_gestion">
                                        <option value=""></option>
                                        @foreach ($gestiones as $gestion)
                                            <option value="{{$gestion->id}}">{{$gestion->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-end mt-4">
                                <x-button class="btn-success btn-sm">Guardar</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
