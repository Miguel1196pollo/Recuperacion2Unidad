<?php
session_start();

//Solo entrara si hay una sesion activa
if (isset($_SESSION['sesion'])) {
    session_destroy();
    ?>
    <!--Redirecciona Al inicio-->
    <script type="text/javascript">
        window.location.href = "../";
    </script>
    <?php
}
?>
