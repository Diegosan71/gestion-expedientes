<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Expedientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-lg p-5 text-center" style="max-width: 400px; width: 100%;">
        <h1 class="mb-4">Gestión de Expedientes</h1>
        <p class="mb-4 text-muted">Bienvenido, por favor inicia sesión o regístrate para continuar.</p>
        <div class="d-grid gap-3">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Registrarse</a>
        </div>
    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
