<?php
// Si quieres proteger esta página, puedes agregar una validación simple
// pero como no usas sesiones, la dejo libre.

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('IMG/FONDO.png') no-repeat center center fixed; /* ← Cambia tu fondo */
            background-size: cover;
        }

        .contenedor {
            width: 450px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            text-align: center;
        }

        .logo {
            width: 140px;
            margin-bottom: 15px;
        }

        h1 {
            margin: 10px 0;
            color: #0d47a1;
            font-size: 28px;
        }

        h3 {
            color: #1976d2;
            margin-bottom: 25px;
        }

        .btn {
            display: block;
            width: 90%;
            padding: 14px;
            margin: 10px auto;
            background: #1976d2;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background: #0d47a1;
        }

        .btn-cerrar {
            background: #d32f2f;
        }

        .btn-cerrar:hover {
            background: #b71c1c;
        }
    </style>
</head>
<body>

<div class="contenedor">

    <!-- Logo de tu empresa -->
    <img src="IMG/LOGO.png" class="logo" alt="Logo de la empresa">  <!-- ← Cambia esta imagen -->

    <h1>Bienvenido</h1>
    <h3>¿Qué deseas hacer?</h3>

    <!-- Botones -->
    <a href="servicios.php" class="btn">Acceder a Servicios</a>
    <a href="CITAS.php" class="btn">Ver Citas</a>
    <a href="index.php" class="btn btn-cerrar">Cerrar Sesión</a>

</div>

</body>
</html>

