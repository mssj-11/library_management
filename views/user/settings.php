<!-- views/user/settings.php -->
<?php
$pageTitle = "Configuración";
require_once '../../config/session.php';
checkAuthentication(); // Verifica si el usuario está autenticado

require_once __DIR__ . '/../../config/constants.php';
require_once CONTROLLERS_PATH . '/user.php';
?>


<?php ob_start(); ?>
<div class="row justify-content-center m-1">
    <div class="card col-md-6"><div class="m-4">
        <h1>Cambiar Contraseña</h1>
        <form method="POST">
            <?php include '../../templates/alerts.php'; ?>
            <div class="mb-3">
                <label for="current_password" class="form-label">Contraseña Actual</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="change_password" class="btn btn-primary mt-4">Cambiar Contraseña</button>
        </form>
    </div></div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>