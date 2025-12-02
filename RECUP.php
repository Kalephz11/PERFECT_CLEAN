<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <style>
        body {
            font-family: Arial;
            background: #e3f2fd;
            padding: 40px;
        }
        .box {
            width: 400px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        h2 {
            color: #0d47a1;
        }
        a {
            color: #1976d2;
            text-decoration: none;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #90caf9;
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background: #1976d2;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #0d47a1;
        }
        .mensaje {
            padding: 10px;
            background: #bbdefb;
            border-left: 4px solid #1976d2;
            margin-top: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Recuperar Contraseña</h2>

    <?php
    // Si el usuario ya envió el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo = $_POST["correo"];
        echo "<div class='mensaje'>
                Si el correo <b>$correo</b> existe en el sistema, se enviará un enlace de recuperación.
              </div>
              <br>
              <a href='RECUP.php'>⮐ Intentar de nuevo</a><br><br>
              <a href='index.php'>Volver al login</a>";
        exit();
    }
    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
    <p>Ingresa tu correo y se envíara el enlace de recuperación.</p>

    <form method="POST">
        <input type="email" name="correo" placeholder="Tu correo..." required>
        <button type="submit">Enviar enlace</button>
    </form>

    <br>
    <a href="index.php">⮐ Volver al login</a>
</div>

</body>
</html>
