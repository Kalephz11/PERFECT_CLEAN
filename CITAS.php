<?php 
// ====== PRIMERA CARGA DESDE PHP ======
$citasGuardadas = [
    ["fecha" => "2025-12-05", "hora" => "10:00", "servicio" => "Limpieza General"],
    ["fecha" => "2025-12-05", "hora" => "11:30", "servicio" => "Lavado de Sala"],
    ["fecha" => "2025-12-06", "hora" => "15:00", "servicio" => "Desinfección"],
    ["fecha" => "2025-12-07", "hora" => "09:30", "servicio" => "Lavado de Colchón"],
    ["fecha" => "2025-12-08", "hora" => "16:00", "servicio" => "Limpieza Profunda"]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mis Citas</title>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial;
        background: url("IMG/FONDO.png") no-repeat center center fixed;
        background-size: cover;
    }

    .container {
        width: 90%;
        max-width: 600px;
        margin: 60px auto;
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }

    .logo {
        width: 110px;
        display: block;
        margin: 0 auto 20px;
    }

    h2 {
        text-align: center;
        color: #0d47a1;
        margin-bottom: 20px;
    }

    .hora-item {
        padding: 15px;
        border-radius: 8px;
        background: #e3f2fd;
        border: 1px solid #64b5f6;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-small {
        padding: 8px 15px;
        background: #1976d2;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
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
        width: 320px;
        padding: 25px;
        border-radius: 12px;
        text-align: center;
    }

    .btn {
        width: 100%;
        padding: 12px;
        background: #1976d2;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 15px;
    }

    .btn:hover {
        background: #0d47a1;
    }

    .hora-option {
        padding: 10px;
        margin: 8px 0;
        border-radius: 6px;
        display: flex;
        justify-content: space-between;
        background: #e3f2fd;
        border: 1px solid #64b5f6;
    }

    /* HORAS OCUPADAS */
    .ocupado {
        background: #d6d6d6 !important;
        border-color: #9e9e9e !important;
        color: #616161 !important;
        cursor: not-allowed;
    }

    /* BOTÓN REGRESAR */
    .btn-back {
        display: block;
        margin: 20px auto 0;
        background: #0d47a1;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        width: fit-content;
        text-decoration: none;
    }
</style>
</head>
<body>

<div class="container">

    <img src="IMG/LOGO.png" class="logo">

    <h2>Mis Citas Guardadas</h2>

    <div id="listaCitas">
        <?php foreach ($citasGuardadas as $index => $cita): ?>
            <div class="hora-item">
                <span>
                    📅 <?= $cita["fecha"] ?> — ⏰ <?= $cita["hora"] ?><br>
                    🧹 <b><?= $cita["servicio"] ?></b>
                </span>
                <button class="btn-small" onclick="abrirReagendar(<?= $index ?>)">Reagendar</button>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="index.php" class="btn-back">⬅ Regresar</a>

</div>

<!-- POPUP REAGENDAR -->
<div class="popup" id="popupReagendar">
    <div class="popup-box">
        <h3 style="color:#0d47a1;">Reagendar Cita</h3>

        <label><b>Nueva fecha:</b></label>
        <input type="date" id="nuevaFecha" onchange="mostrarHoras()">

        <div id="horasReagendar"></div>

        <button class="btn" onclick="cerrarReagendar()">Cerrar</button>
    </div>
</div>

<script>
let citasLocal = localStorage.getItem("citas");
let citas = citasLocal ? JSON.parse(citasLocal) : <?php echo json_encode($citasGuardadas); ?>;
guardarLocal();

function guardarLocal() {
    localStorage.setItem("citas", JSON.stringify(citas));
}

let citaIndex = null;

function abrirReagendar(index) {
    citaIndex = index;
    document.getElementById("popupReagendar").style.display = "flex";
}

function cerrarReagendar() {
    document.getElementById("popupReagendar").style.display = "none";
    document.getElementById("horasReagendar").innerHTML = "";
    document.getElementById("nuevaFecha").value = "";
}

// =============================
// HORAS OCUPADAS PREDEFINIDAS
// =============================
let horasOcupadasDemo = ["10:00", "11:30", "15:00", "16:00"];

function mostrarHoras() {
    let fecha = document.getElementById("nuevaFecha").value;
    let cont = document.getElementById("horasReagendar");
    cont.innerHTML = "";
    if (!fecha) return;

    let horas = ["09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30",
                 "13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30",
                 "17:00","17:30","18:00"];

    horas.forEach(hora => {
        let ocupada = horasOcupadasDemo.includes(hora) ||
                      citas.some(c => c.fecha === fecha && c.hora === hora);

        let div = document.createElement("div");
        div.className = "hora-option " + (ocupada ? "ocupado" : "");

        div.innerHTML = `
            <span>⏰ ${hora}</span>
            <button class="btn-small" 
                    ${ocupada ? "disabled" : ""} 
                    onclick="guardarReagendado('${fecha}','${hora}')">
                ${ocupada ? "Ocupada" : "Elegir"}
            </button>
        `;

        cont.appendChild(div);
    });
}

function guardarReagendado(nuevaFecha, nuevaHora) {
    citas[citaIndex].fecha = nuevaFecha;
    citas[citaIndex].hora = nuevaHora;

    guardarLocal();

    alert("Cita reagendada correctamente.");

    cerrarReagendar();
    actualizarLista();
}

function actualizarLista() {
    const cont = document.getElementById("listaCitas");
    cont.innerHTML = "";

    citas.forEach((cita, index) => {
        cont.innerHTML += `
            <div class="hora-item">
                <span>
                    📅 ${cita.fecha} — ⏰ ${cita.hora}<br>
                    🧹 <b>${cita.servicio}</b>
                </span>
                <button class="btn-small" onclick="abrirReagendar(${index})">Reagendar</button>
            </div>
        `;
    });
}
</script>

</body>
</html>
