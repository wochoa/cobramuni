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
                <P style="font-size: 12px"><b>LISTADO DE INGRESOS DEL DNI/RUC: ({{$rucdni}})</b><br>Direccion: Av. UNIVERSITARIA<br>R.U.C. 20447367727</P>
            </td>
        </tr>
    </table>
    <br>
    <p style="text-align: right">Impreso el : {{date('d/m/Y H:i:s')}}</p>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>N°</th>
                <th>FECHA</th>
                <th>RECIBO</th>
                <th>NOMBRE O RAZON SOCIAL</th>
                <th>IMPORTE</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=0;
            @endphp
            @foreach($lista as $det)
            @php
            $i++
            @endphp
            <tr>
                <td>{{$i}}</td>
                <td>{{$det->fechaemision}}</td>
                <td>{{$det->codigorecibo}}</td>
                <td>{{$det->nom_razonsocial}}</td>
                <td align="right">{{$det->montonumero}}</td>
            </tr>
            @endforeach
        </tbody>
        <thead>
            <tr>
                <td colspan="4" align="right"><b>Total (S/.): </b></td>
                <td align="right"><b>{{$sumas}}</b></td>
            </tr>
        </thead>
    </table>
   </div>
</body>
</html>