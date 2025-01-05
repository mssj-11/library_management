<!-- views/auth/login.php -->
<?php
$pageTitle = "Login";
require_once '../../config/session.php';
redirectIfAuthenticated(); // Redirige al home si el usuario ya está autenticado
require_once __DIR__ . '/../../config/constants.php';
require_once CONTROLLERS_PATH . '/auth.php';
?>

<?php ob_start(); ?>
<div class="row justify-content-center m-1">
    <div class="card col-md-6"><div class="m-4">
        <h1>Iniciar Sesión</h1>
        <form method="POST">
            <?php include '../../templates/alerts.php'; ?>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary mt-4">Iniciar Sesión</button>
            <a href="register.php" class="btn btn-link mt-4">Registrarse</a>
        </form>
    </div></div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>