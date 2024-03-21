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
                            <th>CORREO</th>
                            <th>TELEFONO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personas as $persona)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{$persona->nombre_pers}}</td>
                                <td>{{$persona->apellido_pers}}</td>
                                <td>{{$persona->ci_pers}}</td>
                                <td>{{$persona->correo_pers}}</td>
                                <td>{{$persona->telefono_pers}}</td>

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

{{-- **** FIN CONTENEDOR **** --}}
</div>

