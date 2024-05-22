<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
    </style>
    <title>{{ request()->query('title') }}</title>
</head>
<body>
    <h1 style="text-align:center; font-weight:400">Recibo</h1>

    <table>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Descripción</th>
            <th class="text-center">Tipo</th>
            <th class="text-center">Monto</th>
        </tr>
        @php
            $total = 0;
            $contador = 1;
        @endphp

        @if(request()->query('deudas'))
            @foreach(explode(',', request()->query('deudas')) as $deudaId)
                @php
                    $deuda = DB::table('v_articulo')->where('id', $deudaId)->first();
                @endphp
                @if($deuda)
                    @php
                        $total += $deuda->monto;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $contador++ }}</td>
                        <td>{{ $deuda->descripcion }}</td>
                        <td class="text-center">DEUDA</td>
                        <td class="text-center">{{ $deuda->monto }} Bs</td>
                    </tr>
                @endif
            @endforeach
        @endif

        @if(request()->query('articulos'))
            @foreach(explode(',', request()->query('articulos')) as $articuloId)
                @php
                    $articulo = DB::table('v_articulo')->where('id', $articuloId)->first();
                @endphp
                @if($articulo)
                    @php
                        $total += $articulo->monto;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $contador++ }}</td>
                        <td>{{ $articulo->descripcion }}</td>
                        <td class="text-center">PAGO</td>
                        <td class="text-center">{{ $articulo->monto }} Bs</td>
                    </tr>
                @endif
            @endforeach
        @endif

        <tr>
            <th class="text-center" colspan="3">TOTAL A PAGAR</th>
            <th class="text-center">{{ $total }} Bs</th>
        </tr>
    </table>

    <p style="text-align:right;">Fecha de emisión: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>

    <table style="width:100%; margin-top:50px;">
        <tr>
            <td class="text-center">
                ______________________<br>
                Firma del Administrador
            </td>
            <td class="text-center">
                ______________________<br>
                Firma del Copropietario
            </td>
        </tr>
    </table>
</body>
</html>
