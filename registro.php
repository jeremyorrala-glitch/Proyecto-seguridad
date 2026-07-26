<?php
session_start();
require_once 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];
    $celular = trim($_POST['celular']);

    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE nombre_usuario = ?");
    $stmt->execute([$usuario]);

    if ($stmt->fetch()) {
        $error = "Ese nombre de usuario ya existe.";
    } else {
        // CORREGIDO: la contraseña se guarda con hash bcrypt (nunca en texto plano)
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $insert = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, password, celular) VALUES (?, ?, ?)");
        $insert->execute([$usuario, $password_hash, $celular]);

        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Sistema Transaccional</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="contenedor">
        <h2>Crear Cuenta</h2>
        <form method="POST" action="registro.php">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="text" name="celular" placeholder="Numero de celular" required>
            <button type="submit">Registrarse</button>
        </form>
        <?php if ($error): ?>
            <p class="mensaje-error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
