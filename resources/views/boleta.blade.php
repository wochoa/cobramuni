
<!DOCTYPE html>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<head>

    <style>
        * {
            font-size: 11px;
            font-family: 'DejaVu Sans', serif;
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
            padding: 2px;
        }
        .centrado {
            text-align: center;
            align-content: center;
           
        }

        
       

        * {
            margin: 0;
            padding: 0px 8px 0px 8px;
        }

        
       

       
    </style>
</head>

<body >
    <div class="ticket centrado" style="margin-top: 10px">
        <img src="{{asset('/img/logo.png')}}"   alt="" width="320">
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
    <br>
    <div >
        

        <table style="padding: 5px" align="center" width="100%">
            <thead>
                <tr  style="background: #ccc">
                    <th class="cantidad">N°</th>
                    <th class="producto">CONCEPTO</th>
                    <th class="precio">MONTO</th>
                </tr>
            </thead>
            <tbody>

                    @php
                    $total = 0;
                    $i=0
                    @endphp
                    @foreach ($detcobra as $det) 
                        <tr>
                        @php $i++; @endphp
                        <td class="cantidad">{{$i}}</td>
                        <td width="100%">{{$det->concepto}}</td>
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
        <p class="centrado">¡Pillco Marca, renace contigo!
            </p>
        </div>
    
</body>

</html>