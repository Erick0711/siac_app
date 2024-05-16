<div>
    {{-- **** CONTENEDOR **** --}}
    <div class="card">
        <div class="card-header">
            <div class="row d-flex justify-content-between">
                <div class="col-md-1">
                    @can('agregar-estacionamiento')
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
        @if($estacionamientos->count())
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover ">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>#</th>
                        <th>NUMERO PABELLON</th>
                        <th>NUMERO ESTACIONAMIENTO</th>
                        @can('funciones-estacionamiento')
                            <th>ACCIONES</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estacionamientos as $estacionamiento)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{$estacionamiento->numero_pabellon}}</td>
                            <td>{{$estacionamiento->numero_estacionamiento}}</td>
                            @can('funciones-pabellon')
                                <td class="text-center">
                                    @can('editar-estacionamiento')
                                        <button class="btn btn-warning btn-sm" wire:click="edit({{ $estacionamiento->id }})"><i class="fas fa-pencil-alt"></i></button>
                                    @endcan
                                    @can('eliminar-estacionamiento')
                                        @if ($estacionamiento->estado == 1)
                                            <button class="btn btn-danger btn-sm" wire:click="$dispatch('confirmDelete', {{ $estacionamiento->id }})"><i class="fas fa-trash"></i></button>
                                        @else
                                            <button class="btn btn-primary btn-sm" wire:click="$dispatch('confirmDelete', {{ $estacionamiento->id }})"><i class="fas fa-history"></i></button>
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
            {{$estacionamientos->links()}}
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
                        <h4 class="modal-title font-italic font-weight-bold">AGREGAR ESTACIONAMIENTO</h4>
                        <button type="button" class=" btn btn-danger btn-sm" data-dismiss="modal" wire:click="closeModal">×</button>
                    </div>
        
                    <!-- Contenido del Modal -->
                    <div class="modal-body">
                        <form wire:submit="created">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Pabellon*:</label>
                                    <select class="form-control" wire:model="estacionamiento.id_pabellon" required>
                                        <option value="" selected>SELECCIONAR</option>
                                        @foreach ($pabellones as $pabellon)
                                            <option value="{{$pabellon->id}}">{{$pabellon->numero_pabellon}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="">Estacionamiento*:</label>
                                    <input class="form-control" type="text" wire:model="estacionamiento.numero_estacionamiento" required>
                                </div>
                                <div class="col-md-12 mt-4 validate">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
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
                          <h4 class="modal-title font-italic font-weight-bold">EDITAR ESTACIONAMIENTO</h4>
                          <button type="button" class=" btn btn-danger btn-sm" data-dismiss="modal" wire:click="closeModal">×</button>
                      </div>
          
                      <!-- Contenido del Modal -->
                      <div class="modal-body">
                        <form wire:submit="update">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Pabellon*:</label>
                                    <select class="form-control" wire:model="estacionamiento.id_pabellon">
                                        <option value="" disabled selected>SELECCIONAR</option>
                                        @foreach ($pabellones as $pabellon)
                                            <option value="{{$pabellon->id}}">{{$pabellon->numero_pabellon}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="">Estacionamiento*:</label>
                                    <input class="form-control" type="text" wire:model="estacionamiento.numero_estacionamiento" required>
                                </div>
                                <div class="col-md-12 mt-4 validate">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
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
