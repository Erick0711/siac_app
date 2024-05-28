<div>
    {{-- <button class="btn btn-success mr-2" wire:click="$toggle('openModalNew')"><i class="fas fa-plus-square"></i></button> --}}
    <div class="card">
        <div class="card-header">
            <div class="row d-flex justify-content-between">
                {{-- <div class="col-md-1">
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Buscar..." aria-label="buscar" aria-describedby="basic-addon1" wire:model.live="search">
                    </div>
                </div> --}}
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="">Seleccionar carrera</label>
                    <select class="form-control" wire:change="selectedGestion($event.target.value)">
                        <option value="" selected>Seleccionar</option>
                        @foreach($gestiones as $gestion)
                            <option value="{{$gestion->id}}">{{$gestion->gestion}}</option>
                        @endforeach
                    </select>
                    
                </div>
                @if (count($periodos) > 0)
                <div class="col-md-6">
                    <label for="">Seleccionar periodo</label>
                    <select wire:change="selectedGestion($event.target.value)" class="form-control">
                        <option value="" selected>Seleccionar</option>
                        @foreach($periodos as $periodo)
                            <option value="{{$periodo->id}}">{{$periodo->sigla}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
