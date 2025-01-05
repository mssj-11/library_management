<!-- views/auth/register.php -->
<?php
$pageTitle = "Registro";
require_once '../../config/session.php';
redirectIfAuthenticated(); // Redirige al home si el usuario ya está autenticado
require_once __DIR__ . '/../../config/constants.php';
require_once CONTROLLERS_PATH . '/auth.php';
?>


<?php ob_start(); ?>
<div class="row justify-content-center m-1">
    <div class="card col-md-6"><div class="m-4">
        <h1>Registro</h1>
        <form method="POST">
            <!-- Mensajes de Alertas -->
            <?php include '../../templates/alerts.php'; ?>
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary mt-4">Registrarse</button>
        </form>
    </div></div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>