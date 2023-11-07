<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/styles.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/signup.css">
    <title>signup</title>
</head>

<body>
    <?php require 'views/header.php' ?>
    <div class="container">
        <h1>Registrarse</h1>
        <div class="signup">
            <form action="<?php echo constant('URL') ?>signup/newUser" class="form" method="post">
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" class="text-in" name="user">
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" class="text-in" name="email">
                </div>
                <div class="form-group">
                    <label>Clave</label>
                    <input type="password" class="text-in" name="pass">
                </div>
                <button type="submit" class="btn">Registrarse</button>
            </form>
        </div>
    </div>
</body>

</html>