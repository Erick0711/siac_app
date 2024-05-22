<div>
    <style>
        .card {
            margin-bottom: 20px;
        }
        .card-body {
            display: flex;
            align-items: center;
        }
        .icon-container {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            font-size: 1.5rem;
            margin-right: 15px;
        }
        .card-title {
            margin-bottom: 0;
            font-size: 1.25rem;
            font-weight: 500;
        }
        .card-value {
            font-size: 1rem;
            font-weight: 700;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="icon-container">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Copropietarios</h5>
                            <p class="card-value">{{$cantidad_copropietarios}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <div class="icon-container">
                            <i class="fas fa-building"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Residentes Totales</h5>
                            <p class="card-value">{{$residentes_totales}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <div class="icon-container">
                            <i class="fas fa-paw"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Mascotas</h5>
                            <p class="card-value">{{$total_mascotas}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <div class="icon-container">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Ingresos</h5>
                            <p class="card-value">{{$pago_realizados}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <div class="icon-container">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Deudas pendientes</h5>
                            <p class="card-value">{{$pago_deuda}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <div class="icon-container">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Egresos</h5>
                            <p class="card-value">{{$total_egresos}}</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <a href="{{route("resiboPDF")}}">PDF</a> --}}
            <button wire:click="generatePDF">Generar PDF</button>
    </div>

</div>