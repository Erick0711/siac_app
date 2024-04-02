<div>
    {{-- **** CONTENEDOR **** --}}
            <div class="card">
                @if($permissions->count())
                <div class="card-body">
                    <table class="table table-sm table-bordered table-hover ">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>#</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCIÓN</th>
                                <th>ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->description}}</td>
                                    <td class="text-center">
                                        {{-- @can('register') --}}
                                        <button class="btn btn-warning btn-sm" wire:click="edit({{ $permission->id }})"><i class="fas fa-pencil-alt"></i></button>
                                        {{-- @endcan --}}
                                        @if ($permission->estado == 1)
                                            <button class="btn btn-danger btn-sm" wire:click="$dispatch('confirmDelete', {{ $permission->id }})"><i class="fas fa-trash"></i></button>
                                        @else
                                            <button class="btn btn-primary btn-sm" wire:click="$dispatch('confirmDelete', {{ $permission->id }})"><i class="fas fa-history"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$permissions->links()}}
                </div>
                @else
                    <div class="card-body">
                        <strong class="text-center">No hay registros</strong>
                    </div>
                @endif
            </div>
    
    {{-- **** FIN CONTENEDOR **** --}}
    </div>
    
    