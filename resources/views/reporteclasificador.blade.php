<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            font-size: 11px;
            font-family: 'DejaVu Sans', serif;
        }  
        

    </style>
</head>
<body>
   <div align="center">
    
    <table align="center">
        <tr>
            <td valign="center"><img src="{{asset('/img/logo.jpg')}}"   alt="" height="90"></td>
            <td valign="top">
                <P style="font-size: 12px"><b>LISTADO DE INGRESOS DE FECHA: ({{$fechaini}} - {{$fechafin}}) Y DEL ({{$nombreformato}})</b><br>Direccion: Av. UNIVERSITARIA<br>R.U.C. 20447367727</P>
            </td>
        </tr>
    </table>
    
    <p style="text-align: right">Impreso el : {{date('d/m/Y H:i:s')}}</p>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>N°</th>
                <th>FECHA</th>
                <th>COD. CLASIFICADOR</th>
                <th>CLASIFICADOR</th>
                <th>NOMBRE O RAZON SOCIAL</th>
                <th>IMPORTE</th>
            </tr>
        </thead>
        <tbody>

            @php
            $i=0;            
            @endphp
            @for($cla=0;$cla<count($grupoclasificador);$cla++)

            @php
            $iclasificador=$grupoclasificador[$cla]->idclasificador;
            $monto=0;
            $nombreclasificador='';
            @endphp
                
                @foreach($lista as $det)

                    @if($det->idclasificador==$iclasificador)

                    @php
                    $i++;
                    $nombreclasificador=$det->text_clasificador;
                    @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td nowrap>{{$det->fechaemision}}</td>
                            <td nowrap>{{$det->codigoclasificador}}</td>
                            <td nowrap>{{$det->text_clasificador}}</td>
                            <td>{{$det->nom_razonsocial}}</td>
                            
                            @if ($det->anular==0)
                            <td align="right"><del>{{$det->monto}}</del></td> 
                            @else
                            <td align="right">{{$det->monto}}</td>
                            @php
                                  $monto=$monto+$det->monto;
                                 
                            @endphp 
                            @endif
                        </tr>

                    @endif   
                @endforeach
                <tr style="background: #ccc">
                    <td colspan="5" align="right"><b> {{$nombreclasificador}} - Total (S/.): </b></td>
                    <td align="right"><b>{{$monto}}</b></td>
                </tr>
            @endfor
            


        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" align="right">&nbsp;</td>                
            </tr>
            <tr>
                <td colspan="5" align="right"><b>Total (S/.): </b></td>
                <td align="right"><b>{{$sumas}}</b></td>
            </tr>
            <tr>
                <td colspan="5" align="right"><b>Anuladas (S/.): </b></td>
                <td align="right"><b>{{$anulacion}}</b></td>
            </tr>
            <tr>
                <td colspan="5" align="right"><b>Total caja (S/.): </b></td>
                <td align="right"><b>{{$sumas-$anulacion}}</b><</td>
            </tr>
        </tfoot>
    </table>
   </div>
</body>
</html>