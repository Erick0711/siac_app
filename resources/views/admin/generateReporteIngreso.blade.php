<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }
        .title-section {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            margin: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #151c16;
            color: white;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .total-row td {
            font-weight: bold;
        }
        h1 {
            text-align: center;
            color: #333333;
            margin-bottom: 10px;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            color: #666666;
        }
    </style>
    <title>REPORTE INGRESO</title>
</head>
<body>
    @php
        $gestion = request()->query('gestion');
        $periodo = request()->query('periodo');
    @endphp

        <h1>REPORTE PAGO</h1>

        {{-- <div class="title-section" style="text-align:center">
            <div style="display: inline-block; margin-right: 20px;">
                <h3 style="margin-bottom: 0;">Gestión: {{ $gestion }}</h3>
            </div>
            <div style="display: inline-block;">
                <h3 style="margin-bottom: 0;">Período: {{ $periodo }}</h3>
            </div>
        </div> --}}

    <div class="container">
        <table style="font-size: 14px;">
            <thead>
                <tr>
                    <th style="text-align: center">COPROPIETARIO</th>
                    <th style="text-align: center">PERIODO</th>
                    <th style="text-align: center">DETALLE</th>
                    <th style="text-align: center">FECHA</th>
                    <th style="text-align: center">MONTO</th>
                </tr>
            </thead>
            <tbody>
                
                @php
                    $pagos = DB::table('v_pago')->where('id_gestion', $gestion)->where('id_periodo', $periodo)->where('haber', '>', 0)->get();
                    $total = 0;
                @endphp

                @foreach($pagos as $pago)
                <tr>
                    <td>{{ $pago->nombre }} {{ $pago->apellido }}</td>
                    <td>{{ $pago->periodo }}</td>
                    <td>{{ $pago->descripcion }}</td>
                    <td>{{ $pago->fecha_pago }}</td>
                    <td class="text-right">{{ number_format($pago->haber, 2) }}</td>
                </tr>
                <?php $total += $pago->haber; ?>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4" class="text-right">Total:</td>
                    <td class="text-right">{{ number_format($total, 2) }}Bs</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
