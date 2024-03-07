<div>
    <button class="btn btn-success mr-2" wire:click="$toggle('openModalNew')"><i
        class="fas fa-plus-square"></i></button>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Rol</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <td>{{$rol->name}}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" wire:click="edit({{ $rol->id }})"><i class="fas fa-pencil-alt"></i></button>
                                <button>Eliminar</button>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



        
    {{-- * MODAL --}}
    @if ($openModalNew)
        <!-- Modal -->
        <div class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: block" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Encabezado del Modal -->
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">NUEVO ROL</h4>
                        <button type="button" class=" btn btn-danger btn-sm" data-dismiss="modal" wire:click="closeModal">×</button>
                        {{--  --}}
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

        {{-- * MODAL --}}
        @if ($openModalEdit)
        <!-- Modal -->
        <div class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: block" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Encabezado del Modal -->
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">NUEVO ROL</h4>
                        <button type="button" class=" btn btn-danger btn-sm" data-dismiss="modal" wire:click="closeModal">×</button>
                        {{--  --}}
                    </div>
        
                    <!-- Contenido del Modal -->
                    <div class="modal-body">
                        <form wire:submit="update">
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
    {{--  ** FIN DEL CIERRE --}}
</div>
