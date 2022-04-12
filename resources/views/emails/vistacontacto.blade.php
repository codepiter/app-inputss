<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Solicitud de Contacto</title>
</head>
<body>

Ha recibido un mensaje desde su página web con la siguiente información:<br>

Nombre: {{ $data['fullname']}}<br>
Telefono: {{ $data['phone']}}<br>
Email: {{ $data['email']}} <br><br>

Visite {{$data['url']}} para detallar la informacion

 <div style="text-align: center;">
	<h4><strong></strong></h4>  
 </div>
</body>
</html>




