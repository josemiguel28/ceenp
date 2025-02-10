<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credenciales de acceso | CEENP</title>

</head>
<body style="background-color: #f3f4f6; margin: 0; padding: 20px; font-family: Arial, sans-serif;">

<div
    style="max-width: 600px; margin: 20px auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <h1 style="font-size: 24px; font-weight: bold; color: #1f2937; margin-bottom: 10px;">
        ¡Bienvenido, {{ $student->name }}!</h1>
    <p style="color: #4b5563; font-size: 16px; line-height: 1.5; margin-bottom: 20px;">
        Has sido registrado en nuestro sistema. Aquí están tus credenciales de acceso:
    </p>

    <div
        style="margin-top: 20px; padding: 15px; background-color: #f3f4f6; border: 1px solid #d1d5db; border-radius: 8px;">
        <p style="font-size: 16px; color: #374151;"><strong>Correo:</strong> {{ $student->email }}</p>
        <p style="font-size: 16px; color: #374151;"><strong>Contraseña:</strong> {{ $password }}</p>
    </div>

    <p style="color: #4b5563; font-size: 16px; line-height: 1.5; margin-top: 20px;">
        Puedes iniciar sesión en nuestro sistema utilizando el siguiente enlace:
    </p>

    <a href="{{ url('/') }}?email={{ $student->email }}"
       style="display: block; margin-top: 20px; text-align: center; background-color: #2B5894; color: #ffffff; padding: 10px 15px; text-decoration: none; border-radius: 8px; font-size: 16px; font-weight: bold;">
        Iniciar sesión
    </a>

    <p style="color: #9ca3af; font-size: 14px; line-height: 1.5; margin-top: 20px;">
        Si tienes algún problema, no dudes en contactarnos.
    </p>
</div>
</body>

</html>
