<?php
ob_start(); // inicia buffer de salida

$usuario_correcto = "admin";
$pass_correcta    = "1234";

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if ($usuario === $usuario_correcto && $password === $pass_correcta) {
        header("Location: inicio.php");
        exit();
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Local</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('IMG/FONDO.png') no-repeat center center fixed;
            background-size: cover;
        }

        .login-container {
            width: 350px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            text-align: center;
            margin: 100px auto;
        }

        .logo {
            width: 120px;
            margin-bottom: 20px;
        }

        h2 {
            color: #0d47a1;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #a1c4fd;
            border-radius: 5px;
        }

        .btn-ingresar {
            width: 100%;
            background: #1976d2;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-ingresar:hover {
            background: #0d47a1;
        }

        .olvide {
            display: block;
            margin-top: 15px;
            color: #1976d2;
            text-decoration: none;
            font-size: 14px;
        }

        .olvide:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="login-container">

<img src="IMG/LOGO.png" class="logo" alt="Logo Empresa">

    <h2>Iniciar Sesión</h2>

    <?php if (!empty($mensaje)): ?>
        <div class="error"><?= $mensaje ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>

        <button class="btn-ingresar" type="submit">Ingresar</button>

        <a href="recup.php" class="olvide">¿Olvidaste tu contraseña?</a>
    </form>

</div>

</body>
</html>

<?php
ob_end_flush(); // cierra buffer
