<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Observacion sobre expediente</title>
</head>
<body>
    <h2>Asunto: Observacion sobre expediente</h2>
    <p>Estimados Sr (a). <br>
        {{$expedienteAdhoc->usuario->full_name}}. <br>
        <br>
        Mediante la presente ponemos de su conocimiento que se ha registrado una observacion en el expediente: Nombre comercial {{ $expedienteAdhoc->nombre_comercial }}.
        Número de Hoja de Trámite: {{ $expedienteAdhoc->ht }}.
        <br>
        <br>

        El cual estara disponible en el siguiente link.

        <a href="{{url('/')}}">Sede Electrónica</a>

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
