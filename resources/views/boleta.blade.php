@php
$medidaTicket = 180;

@endphp
<!DOCTYPE html>
<html>

<head>

    <style>
        * {
            font-size: 11px;
            font-family: 'DejaVu Sans', serif;
        }

        h1 {
            font-size: 18px;
        }

        .ticket {
            margin: 2px;
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

        td.precio {
            text-align: right;
            font-size: 11px;
        }

        td.cantidad {
            font-size: 11px;
        }

        td.producto {
            text-align: center;
        }

        th {
            text-align: center;
        }

        .ordenado{
            text-align:justify;
            padding-left: 2px;
        }
        .centrado {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 300px;
            max-width: 300px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .ticket {
            margin: 0;
            padding: 0;
        }

        body {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="ticket centrado">
        <img src="{{asset('/img/logo.png')}}"  alt="">
        <h2>R.U.C. 20447367727</h2>
        <p>Fecha imp.: {{$fechaimpresion}}</p>
        
    </div>
    <div class="ordenado">
        <p> <strong> RECIBO DE CAJA N°</strong> {{$cobra[0]->codigorecibo}}</p>
        <p> <strong> FECHA EMISIÓN:</strong> {{$cobra[0]->fechaemision}}</p>        
        <p> <strong> DNI/RUC:</strong>
            @if ($cobra[0]->ruc<>'null')
            {{$cobra[0]->ruc}}
            @else
            {{$cobra[0]->dni}}
            @endif
            </p>
            <p> <strong> NOMBRE O RAZON SOCIAL:</strong><br> {{strtoupper($cobra[0]->nom_razonsocial)}}</p>
    </div>
    <div class="ticket">
        

        <table style="padding: 2px">
            <thead>
                <tr class="centrado" style="background: #ccc">
                    <th class="cantidad">ITEM</th>
                    <th class="producto">CONCEPTO</th>
                    <th class="precio">MONTO</th>
                </tr>
            </thead>
            <tbody>

                    @php
                    $total = 0;
                    $i=0
                    @endphp
                    @foreach ($detcobra as $det) {
                        <tr>
                        @php $i++; @endphp
                        <td class="cantidad">{{$i}}</td>
                        <td style="padding-left: 2px">{{$det->concepto}}</td>
                        <td class="precio">{{$det->monto}}</td>
                    </tr>
                    @endforeach

            </tbody>
            <tr style="background: #ccc">
                <td class="cantidad"></td>
                <td class="producto">
                    <strong>TOTA PAGADO S/.</strong>
                </td>
                <td class="precio">
                    {{-- @php echo number_format($total, 2) @endphp --}}
                    {{ $cobra[0]->montonumero }}
                </td>
            </tr>
        </table>
        <p class="centrado">
            SON: {{$cobra[0]->montotexto}}
        </p><br>
        <p class="centrado">¡Pillco Marca renace contigo!
            </p>
        </div>
    
</body>

</html>