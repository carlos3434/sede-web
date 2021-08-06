<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud del número de hoja de trámite</title>
</head>
<body>
    <h2>Asunto: Entrega de Informe VAH</h2>
    <p>Estimados Sres. <br>
        {{$diligencia->entrega->expediente->usuario->full_name}}. <br>
        <br>
        Mediante la presente ponemos de su conocimiento que ya se encuentra listo el informe de VAH correspondiente al expediente HT {{$diligencia->entrega->expediente->ht}}.
        El cual estara disponible en el siguiente link.

        <a href="{{url('/diligencia/'.$diligencia->id.'/descarga-informe')}}">Descargar Informe VAH</a>

        <br>
        <br>
        <br>
        Atentamente
        <br>
        <br>
        <br>
         CENEPRED
    </p>

</body>
</html>
