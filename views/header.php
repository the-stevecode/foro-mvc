<header>
    <nav>
        <div class="nav-left">
            <a href="<?php echo  constant('URL') ?>">Inicio</a>
            <a href="<?php echo  constant('URL') ?>thread">Hilos</a>
        </div>
        <div class="nav-right">
            <?php
            if (isset($user)) {

                echo '<label class="h_user"> <span class="i-user"></span>' . $user->getUsername() . '</label>';
                echo '<a href="' . constant('URL') . 'logout" class="h_link"><span class="i-logout"></span> Cerrar sesión</a>';
            } else {
                echo '<a href="' . constant('URL') . 'signup" class="h_link">Registrase</a>';
                echo '<a href="' . constant('URL') . 'login" class="h_link"><span class="i-login"></span> Ingresar</a>';
            }
            ?>

        </div>
    </nav>
</header>