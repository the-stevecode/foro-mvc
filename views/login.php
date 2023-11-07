<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/styles.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/login.css">
    <title>Login</title>
</head>

<body>
    <?php require 'views/header.php' ?>
    <div class="container">
        <h1>Inciar sesión</h1>
        <div class="login">
            <form action="<?php echo constant('URL') ?>login/auth" class="form" method="post">
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" class="text-in" name="user">
                </div>
                <div class="form-group">
                    <label>Clave</label>
                    <input type="password" class="text-in" name="pass">
                </div>
                <button type="submit" class="btn">Iniciar</button>
            </form>
        </div>
    </div>
</body>

</html>