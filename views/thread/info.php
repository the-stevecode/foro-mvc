<?php
$thread = $this->d['thread'];
$user = $this->d['user'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/styles.css">
    <title>Info</title>
</head>

<body>
    <?php require 'views/header.php' ?>
    <div class="container">
        <div class="thread-info">
            <div class="thread-header">
                <h2><?php echo $thread['titulo']; ?></h2>
            </div>
            <div class="thread-content">
                <p><?php echo $thread['contenido']; ?></p>
            </div>
            <div class="thread-footer">
                <div>
                    <label class="t_user"><?php echo $thread['usuario']['usuario']; ?></label> | <label class="t_public-date">Fecha de publicación:</label><span><?php echo $thread['fecha_creacion']; ?></span>
                </div>
                <div>
                    <span>Respuestas: <?php echo ($thread['respuestas']) ? count($thread['respuestas']) : 0; ?></span>
                </div>
            </div>
        </div>

        <?php
        if ($user) {
        ?>
            <div class="new-answer">
                <form action="<?php echo constant('URL') ?>thread/respondToThread/<?php echo $thread['id'] ?>" class="form" method="post">
                    <div class="form-group">
                        <label>Escribe una respuesta como <span class="user"><?php echo $user->getUsername(); ?> </span></label>
                        <textarea name="content" class="text-in" cols="30" rows="5" placeholder="Escribe un comentario..."></textarea>
                    </div>
                    <button type="submit" class="btn"> Enviar</button>
                </form>
            </div>
        <?php
        } else {
            echo '<div class="message"> ¿Quieres responder a este hilo? Tienes que <a href="' . constant('URL') . 'login">Ingresar</a> con tu cuenta</div>';
        }
        ?>
        <div class="answers">
            <?php
            if ($thread['respuestas']) {
                foreach ($thread['respuestas'] as $answer) {
            ?>
                    <div class="answer">
                        <div class="answer-content">
                            <p><?php echo $answer['contenido']; ?></p><br>
                            <?php if ($user && $user->getId() == $answer['usuario']['id'])echo '<a href="'. constant('URL').'thread/deleteAnswer/'. $answer['id'] .'" class="btn"> Eliminar</a>'; ?>
                        </div>
                        <div class="answer-footer">
                            <label class="t_user"><?php echo $answer['usuario']['usuario']; ?></label> | <label class="t_public-date">Fecha de publicación:</label><span><?php echo $answer['fecha_creacion']; ?></span>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>


    </div>
</body>

</html>