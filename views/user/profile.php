<!-- views/user/profile.php-->
<?php
$pageTitle = "Perfil";
require_once '../../config/session.php';
checkAuthentication(); // Verifica si el usuario está autenticado

require_once __DIR__ . '/../../config/constants.php';
require_once CONTROLLERS_PATH . '/user.php';

// Obtener los datos del usuario
$userData = getUserData();  // Llamamos a la función para obtener los datos del usuario
if (!$userData) {
    // Si no se encuentran los datos, redirige a la página de login
    header('Location: /library_management/views/auth/login.php');
    exit;
}

$userName = $userData['name'];  // Nombre del usuario
$userEmail = $userData['email'];  // Correo electrónico del usuario
?>

<?php ob_start(); ?>
<div class="row justify-content-center m-1">
    <div class="card col-md-6">
    <div class="m-4">
        <h1>Perfil</h1>
        <!-- Formulario de actualización de perfil -->
        <form method="POST">
            <!-- Mensajes de Alertas -->
            <?php include '../../templates/alerts.php'; ?>
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($userName); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($userEmail); ?>" required>
            </div>
            <button type="submit" name="update_profile" class="btn btn-primary mt-4">Actualizar Perfil</button>
        </form>
    </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>