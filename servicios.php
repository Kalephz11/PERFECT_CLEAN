<?php
// LEER JSON DIRECTAMENTE DEL LINK
$url = 'https://raw.githubusercontent.com/ThePol99/perfect_clean_services/main/listado_servicios.json';

$json = file_get_contents($url);
if ($json === false) {
    die("No se pudo obtener el JSON del enlace.");
}

$servicios = json_decode($json, true);
if ($servicios === null) {
    die("Error: JSON inválido.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servicios</title>
    <style>
        body {
            margin: 0; padding: 0;
            font-family: Arial, sans-serif;
            background: url('IMG/FONDO.png') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 50px auto;
            background: rgba(255,255,255,0.93);
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }

        .logo {
            width: 130px;
            margin-bottom: 20px;
        }

        h1 {
            color: #0d47a1;
            margin-bottom: 25px;
        }

        .btn-servicio {
            display: block;
            width: 90%;
            margin: 12px auto;
            padding: 15px;
            background: #1976d2;
            color: white;
            border-radius: 8px;
            text-align: left;
            font-size: 17px;
            cursor: pointer;
            transition: 0.2s;
            border: none;
        }

        .btn-servicio:hover {
            background: #0d47a1;
        }

        .titulo { 
            font-size: 20px; 
            font-weight: bold; 
            display: block; 
            margin-bottom: 8px;
        }

        .descripcion { 
            font-size: 15px; 
            opacity: 0.9; 
            display: block; 
            margin-bottom: 5px;
        }

        .precio { 
            font-size: 16px; 
            font-weight: bold; 
            display: block; 
        }

        .btn-volver {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #555;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-volver:hover {
            background: #333;
        }

        /* POPUP */
        .popup {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .popup-box {
            background: white;
            width: 300px;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .popup-box h2 {
            margin-bottom: 20px;
            color: #0d47a1;
        }

        .btn-si, .btn-no {
            width: 40%;
            padding: 10px;
            font-size: 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            margin: 10px;
        }

        .btn-si { background: #1976d2; color:white; }
        .btn-si:hover { background: #0d47a1; }

        .btn-no { background: #d32f2f; color:white; }
        .btn-no:hover { background: #b71c1c; }

    </style>
</head>
<body>

<div class="container">

    <img src="IMG/LOGO.png" class="logo" alt="Logo Empresa">

    <h1>Lista de Servicios</h1>

    <?php foreach ($servicios as $s): ?>
        <button class="btn-servicio" onclick="abrirPopup('<?php echo addslashes($s['nombre']); ?>')">
            <span class="titulo"><?php echo htmlspecialchars($s['nombre']); ?></span>
            <span class="descripcion"><?php echo htmlspecialchars($s['descripcion']); ?></span>
            <span class="precio">Precio: $<?php echo htmlspecialchars($s['precio']); ?></span>
        </button>
    <?php endforeach; ?>

    <a href="inicio.php" class="btn-volver">Volver</a>

</div>

<!-- POPUP -->
<div class="popup" id="popup">
    <div class="popup-box">
        <h2 id="tituloServicio"></h2>
        <p>¿Deseas agendar cita?</p>
        <button class="btn-si" onclick="agendar()">Sí</button>
        <button class="btn-no" onclick="cerrarPopup()">No</button>
    </div>
</div>

<script>
    let servicioSeleccionado = "";

    function abrirPopup(nombre) {
        servicioSeleccionado = nombre;
        document.getElementById("tituloServicio").textContent = nombre;
        document.getElementById("popup").style.display = "flex";
    }

    function cerrarPopup() {
        document.getElementById("popup").style.display = "none";
    }

    function agendar() {
        // Redirigir a reserva.php con servicio seleccionado
        window.location.href = "reserva.php?servicio=" + encodeURIComponent(servicioSeleccionado);
    }
</script>

</body>
</html>
