<?php

require 'db/database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nombre'])) {
    $sql = "INSERT INTO users (nombre, email, password) VALUES (:nombre, :email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        $message = 'Usuario creado con exito';
    } else {
        $message = 'Ocurrio un error al crear el usuario';
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="static/css/bootstrap.css">
    <link rel="stylesheet" href="static/css/index.css">


</head>

<body>
    <?php if (!empty($message)) : ?>
        <div class="alert alert-success" role="alert">
        <?= $message ?>
        </div>

    <?php endif; ?>
    <form method="POST" action="registro.php" class="formulario">

        <h1>Registrate</h1>
        <div class="contenedor">

            <div class="input-contenedor">
                <i class="fas fa-user icon"></i>
                <input type="text" name="nombre" placeholder="Nombre Completo">

            </div>

            <div class="input-contenedor">
                <i class="fas fa-envelope icon"></i>
                <input type="text" name="email" placeholder="Correo Electronico">

            </div>

            <div class="input-contenedor">
                <i class="fas fa-key icon"></i>
                <input type="password" name="password" placeholder="Contraseña">

            </div>
            <input type="submit" value="Registrate" class="button">
            <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
            <p>¿Ya tienes una cuenta?<a class="link" href="index.php">Iniciar Sesion</a></p>
        </div>
    </form>
</body>

</html>