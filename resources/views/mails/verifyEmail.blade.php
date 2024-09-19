<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @once
        <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    @endonce
    <title>Document</title>
</head>
<body>

    <h1 class="text-lg font-bold text-gray-800">Correo electronico verificacion de Email</h1>
    <h4>Para usar la plataforma de CautroPatitas, debe verificar su correo con el link de abajo!</h4>

    <a href="{{$link . '/'.$token}}">Verificar Correo</a>
</body>
</html>