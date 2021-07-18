<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud del número de hoja de trámite</title>
</head>
<body>
    <h2>Asunto: Solicito número de hoja de trámite</h2>
    <p>Estimados señores de Mesa de partes <br>CENEPRED <br> <br> Mi nombre es {{$datos['usuario']->name}} {{$datos['usuario']->ap}} {{$datos['usuario']->am}} con N° DNI {{$datos['usuario']->numero_documento}}, con el debido respeto mediante la presente solicito el N° de hoja de trámite para solicitar la verificación AdHoc y asi proceder enviar mi expediente al área correspondiente para su respectiva evaluación. <br> <br> Adjunto el anexo nº 5 y el recibo de pago. <br> <br> <br> Atentamente, <br> <br> {{$datos['usuario']->name}} {{$datos['usuario']->ap}} {{$datos['usuario']->am}} <br> DNI: {{$datos['usuario']->numero_documento}} </p>
    <!-- u2-6-archivo_solicitud_ht.pdf -->
</body>
</html>