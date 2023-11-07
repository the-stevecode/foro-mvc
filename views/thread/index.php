<?php
$threads = $this->d['threads'];
$user = $this->d['user'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/styles.css">
    <title>Thread</title>
</head>

<body>
    <?php require 'views/header.php' ?>
    <div class="container">
        <h1>Hilos</h1>
        <?php
        if ($user) {
        ?>
            <div class="new-thread">
                <form action="<?php echo constant('URL') ?>thread/newThread" class="form" method="post">
                    <div class="form-group">
                        <label>titulo</label>
                        <input type="text" class="text-in" name="title">
                    </div>
                    <div class="form-group">
                        <label>Contenido</label>
                        <textarea name="content" class="text-in" cols="30" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn"> Publicar</button>
                </form>
            </div>
        <?php
        } else {
            echo '<div class="message"> ¿Quieres publicar un hilo? Tienes que <a href="' . constant('URL') . 'login">Ingresar</a> con tu cuenta </div>';
        }
        ?>

        <div class="threads">
            <?php
            foreach ($threads as $thread) {
            ?>

                <div class="thread">
                    <div class="thread-header">
                        <h2><a href="<?php echo constant('URL') . 'thread/info/' . $thread['id'] ?>"><?php echo $thread['titulo']; ?></a></h2>
                    </div>
                    <div class="thread-content">
                        <p><?php echo $thread['contenido']; ?></p>
                    </div>
                    <div class="thread-footer">
                        <div>
                            <label class="t_user"></span> <?php echo $thread['usuario']['usuario']; ?></label> | <label class="t_public-date">Fecha de publicación:</label><span><?php echo $thread['fecha_creacion']; ?></span>
                        </div>
                        <div>
                            <span>respuestas: <?php echo $thread['respuestas']; ?></span>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>

    </div>
</body>

</html>