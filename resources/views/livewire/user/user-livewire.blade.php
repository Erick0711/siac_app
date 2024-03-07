<div>
    <div class="card">
        <div class="card-header">
            <input type="text" class="form-control" placeholder="Buscar..." wire:model.live="search">
        </div>
        @if($users->count())
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>NOMBRE</th>
                        <th>EMAIL</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->email}}</td>
                            <td>{{$user->name}}</td>
                            <td class="text-center">
                                @can('register')
                                <button class="btn btn-warning btn-sm" wire:click="edit({{ $user->id }})"><i class="fas fa-pencil-alt"></i></button>
                                @endcan
                               
                                {{-- @if ($funcionario->estado == 1)
                                      <button class="btn btn-danger btn-sm" wire:click="$dispatch('confirmDelete', {{ $funcionario->id_funcionario }})"><i class="fas fa-trash"></i></button>
                                @else
                                      <button class="btn btn-primary btn-sm" wire:click="$dispatch('confirmDelete', {{ $funcionario->id_funcionario }})"><i class="fas fa-history"></i></button>
                                @endif --}}
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{$users->links()}}
        </div>
        @else
            <div class="card-body">
                <strong class="text-center">No hay registros</strong>
            </div>
        @endif
    </div>


    
    {{-- * MODAL --}}
    @if ($openModalEdit)
        <!-- Modal -->
        <div class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: block" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Encabezado del Modal -->
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">EDITAR PERSONA</h4>
                        <button type="button" class=" btn btn-danger btn-sm" data-dismiss="modal" wire:click="closeModal">×</button>
                        {{--  --}}
                    </div>
        
                    <!-- Contenido del Modal -->
                    <div class="modal-body">
                        <form wire:submit="update">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Email:</label>
                                    <input class="form-control" type="text" wire:model="usuarios.email" required>
                                </div>
                                <div class="col-md-6 mt-4">
                                    @foreach ($roles as $rol)
                                        <label>
                                            {{$rol->name}}
                                            <input type="checkbox" wire:model="selectedRoles.{{ $rol->id }}">
                                        </label>
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

</div>
