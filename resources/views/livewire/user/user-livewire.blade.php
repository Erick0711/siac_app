<div>
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
    @if ($openModalNew)
        <!-- Modal -->
        <div class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: block" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Encabezado del Modal -->
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">EDITAR USUARIO</h4>
                        <button type="button" class=" btn btn-danger btn-sm" data-dismiss="modal" wire:click="closeModal">×</button>
                        {{--  --}}
                    </div>
        
                    <!-- Contenido del Modal -->
                    <div class="modal-body">
                        <form wire:submit="update">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" wire:model="obtenerIdPersona" required>
                                    <label for="">Buscar Persona:*</label>
                                    <input type="text" class="form-control buscar" placeholder="Buscar" aria-label="Buscador" wire:model.live="searchPersona" 
                                    @if($selectedPersona) disabled @endif>
                                </div>
                                <div class="col-md-12 rounded p-3 mt-2" id="contenedorBuscador">
                                    @isset($personas)
                                          @if($personas->isNotEmpty())
                                       <table class="table table-bordered table-sm table-hover">
                                          <thead class="bg-secondary">
                                             <tr class="text-center">
                                                <th>NOMBRE</th>
                                                <th>CI</th>
                                                <th>ACCION</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             @foreach($personas as $persona)
                                                <tr class="persona-row" wire:key="persona-{{$persona->id}}" data-id="{{$persona->id}}" @if($selectedPersona && $obtenerIdPersona != $persona->id) style="display: none;" @endif>
                                                      <td>{{ $persona->nombre_pers }} {{ $persona->apellido_pers }}</td>
                                                      <td class="text-center">{{ $persona->ci_pers }}</td>
                                                      <td class="text-center">
                                                         <a wire:click="seleccionarPersona({{ $persona->id }})"
                                                            class="btn @if($obtenerIdPersona == $persona->id) btn-danger @else btn-outline-success @endif btn-sm botones ">
                                                            @if($obtenerIdPersona == $persona->id)
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
                                       <tr>
                                          <th colspan="5" class="text-center">No hay personas encontradas.</th>
                                       </tr>
                                          <p class="text-center"></p>
                                       @endif
                                    @endisset
                                    {{-- {{dd($personas)}} --}}
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
