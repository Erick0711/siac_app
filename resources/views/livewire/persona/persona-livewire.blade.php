<div>
{{-- **** CONTENEDOR **** --}}
        <div class="card">
            <div class="card-header">
                <div class="row d-flex justify-content-between">
                    <div class="col-md-1">
                        <button class="btn btn-success btn-md" wire:click="$toggle('openModalNew')"><i class="fas fa-plus-square"></i></button>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="buscar" aria-label="buscar" aria-describedby="basic-addon1" wire:model.live="search">
                        </div>
                    </div>
                </div>

            </div>
            @if($personas->count())
            <div class="card-body">
                <table class="table table-sm table-bordered table-hover ">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>APELLIDO</th>
                            <th>CI</th>
                            <th>PAIS</th>
                            <th>CORREO</th>
                            <th>TELEFONO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personas as $persona)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{$persona->nombre}}</td>
                                <td>{{$persona->apellido}}</td>
                                <td>{{$persona->ci ."-".$persona->complemento_ci}}</td>
                                <td>{{$persona->pais}}</td>
                                <td>{{$persona->correo}}</td>
                                <td>{{$persona->telefono}}</td>

                                <td class="text-center">
                                    {{-- @can('register') --}}
                                    <button class="btn btn-warning btn-sm" wire:click="edit({{ $persona->id }})"><i class="fas fa-pencil-alt"></i></button>
                                    {{-- @endcan --}}
                                    @if ($persona->estado == 1)
                                        <button class="btn btn-danger btn-sm" wire:click="$dispatch('confirmDelete', {{ $persona->id }})"><i class="fas fa-trash"></i></button>
                                    @else
                                        <button class="btn btn-primary btn-sm" wire:click="$dispatch('confirmDelete', {{ $persona->id }})"><i class="fas fa-history"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$personas->links()}}
            </div>
            @else
                <div class="card-body">
                    <strong class="text-center">No hay registros</strong>
                </div>
            @endif
        </div>



        {{-- *** MODAL AGREGAR PERSONA --}}

        @if ($openModalNew)
        <!-- Modal -->
            <div class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: block" aria-modal="true" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Encabezado del Modal -->
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title">NUEVO ROL</h4>
                            <button type="button" class=" btn btn-danger btn-sm" data-dismiss="modal" wire:click="closeModal">×</button>
                        </div>
            
                        <!-- Contenido del Modal -->
                        <div class="modal-body">
                            <form wire:submit="created">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Nombre Rol:</label>
                                        <input class="form-control" type="text" wire:model="rol.name" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="">Lista permisos:</label>
                                        @foreach ($permissions as $permission)
                                            <div>
                                                {{-- <label for="">{{ $permission->id }}</label> --}}
                                                <label for="">
                                                    <input type="checkbox" wire:model="selectedPermission.{{ $permission->id }}">
                                                    {{$permission->description}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                                <div class="row d-flex justify-content-end mt-4">
                                    <x-button class="btn-success btn-sm">Guardar</x-button>
                                </div>
                            </form>
                        </div>
            
                        
                        
                    </div>
                </div>
            </div>
        @endif

        {{-- *** FIN MODAL AGREGAR PERSONA --}}

{{-- **** FIN CONTENEDOR **** --}}
</div>

