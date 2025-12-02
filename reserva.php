<?php
$reserva = null;

// Tomar servicio desde GET si viene
$servicio_prefill = $_GET['servicio'] ?? '';

// Procesar formulario al hacer submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servicio = $_POST['servicio'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $observaciones = $_POST['observaciones'] ?? '';
    $metodo_pago = $_POST['metodo_pago'] ?? '';

    $fecha_formato = date('d/m/Y', strtotime($fecha));

    $reserva = [
        'servicio' => htmlspecialchars($servicio),
        'fecha' => $fecha_formato,
        'hora' => htmlspecialchars($hora),
        'direccion' => htmlspecialchars($direccion),
        'observaciones' => htmlspecialchars($observaciones),
        'metodo_pago' => htmlspecialchars($metodo_pago)
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reserva de Servicio</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0; padding: 0;
    background: url('IMG/FONDO.png') no-repeat center center fixed;
    background-size: cover;
}
.container {
    width: 90%;
    max-width: 600px;
    margin: 50px auto;
    background: rgba(255,255,255,0.95);
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.3);
}
h1 {
    color: #0d47a1;
    text-align: center;
    margin-bottom: 25px;
}
label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
}
input[type="text"], input[type="date"], textarea, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 15px;
    box-sizing: border-box;
}
textarea { resize: vertical; height: 80px; }
.btn-guardar {
    display: block;
    width: 100%;
    margin-top: 20px;
    padding: 15px;
    background: #1976d2;
    color: white;
    font-size: 18px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
}
.btn-guardar:hover { background: #0d47a1; }
.resumen {
    margin-top: 30px;
    padding: 15px;
    background: #f5faff;
    border-radius: 8px;
    border: 1px solid #a1c4fd;
}
.resumen h2 { margin-top: 0; color: #0d47a1; }
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
.btn-volver:hover { background: #333; }

/* Reloj sin flecha */
#relojCSS {
    position: relative;
    width: 300px;
    height: 300px;
    margin: 20px auto;
    border: 4px solid #1976d2;
    border-radius: 50%;
    background: #f5faff;
}
.horaNumero {
    position: absolute;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 1px solid #1976d2;
    background: #fff;
    text-align: center;
    line-height: 30px;
    cursor: pointer;
    user-select: none;
    transition: 0.2s;
}
.horaNumero:hover {
    background: #1976d2;
    color: white;
}
.horaNumero.seleccionada {
    background: #1976d2;
    color: white;
}
.minutoBtn {
    padding: 10px 20px;
    margin: 0 10px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 8px;
    border: 1px solid #1976d2;
    background: #fff;
}
.minutoBtn:hover { background: #1976d2; color: white; }
.minutoBtn.seleccionado {
    background: #1976d2;
    color: white;
}
</style>
</head>
<body>

<div class="container">
<h1>Reserva de Servicio</h1>

<form method="post">
    <label for="servicio">Servicio:</label>
    <input type="text" name="servicio" id="servicio" value="<?php echo htmlspecialchars($servicio_prefill); ?>" required>

    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" id="fecha" required min="2025-01-01" max="2025-12-31">

    <label>Hora:</label>
    <div id="relojCSS">
        <?php
        for ($h = 4; $h <= 20; $h++) {
            $angle = (($h-4)/16)*360 - 90;
            $x = 50 + 40 * cos(deg2rad($angle));
            $y = 50 + 40 * sin(deg2rad($angle));
            $h_formato = str_pad($h,2,"0",STR_PAD_LEFT);
            echo "<div class='horaNumero' data-hora='$h_formato' style='left:{$x}%; top:{$y}%; transform:translate(-50%,-50%);'>$h_formato</div>";
        }
        ?>
    </div>

    <div id="minutosContainer" style="text-align:center; margin-top:15px;">
        <button type="button" class="minutoBtn" data-min="00">00</button>
        <button type="button" class="minutoBtn" data-min="30">30</button>
    </div>

    <input type="hidden" name="hora" id="horaInput" required>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" required>

    <label for="observaciones">Observaciones:</label>
    <textarea name="observaciones"></textarea>

    <label for="metodo_pago">Método de Pago:</label>
    <select name="metodo_pago" id="metodo_pago" required>
        <option value="">--Seleccione--</option>
        <option value="Efectivo">Efectivo</option>
        <option value="Tarjeta Visa">Tarjeta Visa</option>
        <option value="Yape">Yape</option>
    </select>

    <button type="submit" class="btn-guardar">Guardar</button>
</form>

<?php if ($reserva): ?>
<div class="resumen">
    <h2>📝 Resumen de tu reserva</h2>
    <p>🛎️ <strong>Servicio:</strong> <?= $reserva['servicio']; ?></p>
    <p>📅 <strong>Fecha:</strong> <?= $reserva['fecha']; ?></p>
    <p>⏰ <strong>Hora:</strong> <?= $reserva['hora']; ?></p>
    <p>📍 <strong>Dirección:</strong> <?= $reserva['direccion']; ?></p>
    <p>📝 <strong>Observaciones:</strong> <?= $reserva['observaciones']; ?></p>
    <p>💳 <strong>Método de Pago:</strong> <?= $reserva['metodo_pago']; ?></p>
</div>
<?php endif; ?>

<a href="servicios.php" class="btn-volver">Volver a Servicios</a>
</div>

<script>
let horaSeleccionada = '';
let minutoSeleccionado = '';

document.querySelectorAll('.horaNumero').forEach(el=>{
    el.addEventListener('click', ()=>{
        horaSeleccionada = el.dataset.hora;
        document.querySelectorAll('.horaNumero').forEach(n => n.classList.remove('seleccionada'));
        el.classList.add('seleccionada');
        actualizarHora();
    });
});

document.querySelectorAll('.minutoBtn').forEach(btn=>{
    btn.addEventListener('click', ()=>{
        minutoSeleccionado = btn.dataset.min;
        actualizarHora();
        document.querySelectorAll('.minutoBtn').forEach(n => n.classList.remove('seleccionado'));
        btn.classList.add('seleccionado');
    });
});

function actualizarHora(){
    if(horaSeleccionada && minutoSeleccionado){
        document.getElementById('horaInput').value = horaSeleccionada + ":" + minutoSeleccionado;
    }
}
</script>

</body>
</html>
