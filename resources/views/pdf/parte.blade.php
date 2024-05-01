<html lang="en">
<head>
    <title>Parte</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="px-2 py-8 max-w-xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center">
            <div class="text-gray-700 font-semibold text-lg">REPARACIONES</div>
        </div>
        <div class="text-gray-700">
            <div class="font-bold text-xl mb-2 uppercase">PARTE</div>
            <div class="text-sm">Fecha: {{$parte->fecha}}</div>
            <div class="text-sm">Nº #: {{ $parte->numero }}</div>
        </div>
    </div>
    <div>
        <h2 class="text-xl font-bold mb-2" >Cliente:</h2>
        <div class="text-gray-700 mb-1">{{ $parte->cliente->nombre }}</div>
        <div class="text-gray-700 mb-1">{{$parte->cliente->direccion}}</div>
        <div class="text-gray-700 mb-1">{{$parte->cliente->provincia}}</div>
        <div class="text-gray-700">{{$parte->cliente->email}}</div>
    </div>
    <div>
        <h2 class="text-xl font-bold mb-2">Reparación:</h2>
        <p class="text-gray-700 mb-1"><b>Máquina:</b> {{$parte->maquina }}</p>
        <p class="text-gray-700 mb-1"><b>Avería:</b> {{$parte->averia}}</p>
        <p class="text-gray-700 mb-1"><b>Reparación:</b> {{$parte->reparacion}}</p>
    </div>
    <table class="w-full text-left mb-8">
        <thead>
        <tr>
            <th class="text-gray-700 font-bold uppercase py-2">Descripción</th>
            <th class="text-gray-700 font-bold uppercase py-2">Precio</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="py-4 text-gray-700">Mano de obra</td>
            <td class="py-4 text-gray-700">{{$parte->mano_obra}} €</td>
        </tr>
        <tr>
            <td class="py-4 text-gray-700">Desplazamiento</td>
            <td class="py-4 text-gray-700">{{$parte->desplazamiento}} €</td>
        </tr>
        <tr>
            <td class="py-4 text-gray-700">Portes</td>
            <td class="py-4 text-gray-700">{{$parte->portes}} €</td>
        </tr>
        <tr>
            <td class="py-4 text-gray-700">Materiales</td>
            <td class="py-4 text-gray-700">{{$parte->materiales}} €</td>
        </tr>
        </tbody>
    </table>
    <div class="flex justify-end mb-8">
        <div class="text-gray-700 mr-2">Subtotal:</div>
        <div class="text-gray-700">{{$parte->subtotal}} €</div>
    </div>
    <div class="text-right mb-8">
        <div class="text-gray-700 mr-2">IVA:</div>
        <div class="text-gray-700">{{$parte->iva}} %</div>

    </div>
    <div class="flex justify-end mb-8">
        <div class="text-gray-700 mr-2">Total:</div>
        <div class="text-gray-700 font-bold text-xl">{{$parte->total}} €</div>
    </div>
</div>

</body>
</html>