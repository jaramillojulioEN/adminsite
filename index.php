<?php

session_start();

require 'db/database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: templates/pedidos.php");
    } else {
        $message = 'Correo y/o contraseña incorrectos';
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="static/css/bootstrap.css">
    <link rel="stylesheet" href="static/css/index.css">


</head>

<body>
    <?php if (!empty($message)) : ?>
        <div class="alert alert-danger" role="alert">
        <p> <?= $message ?></p>
        </div>
    <?php endif; ?>
    <form class="formulario" action="index.php" method="POST">
        <h1>BIENVENIDO</h1>
        <h3>Inicia Sesión</h3>
        <hr>
        <div class="contenedor">
            <div class="input-contenedor">
                <i class="fas fa-envelope icon"></i>
                <input type="text" placeholder="Correo Electronico" name="email">

            </div>

            <div class="input-contenedor">
                <i class="fas fa-key icon"></i>
                <input type="password" placeholder="Contraseña" name="password">

            </div>
            <input type="submit" value="Login" class="button">
            <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
            <p>¿No tienes una cuenta? <a class="link" href="registro.php">Registrate </a></p>
        </div>
    </form>
</body>

</html>