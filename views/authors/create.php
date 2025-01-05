<!-- views/authors/create.php -->
<?php
$pageTitle = "Crear Autor";
require_once '../../config/session.php';
require_once __DIR__ . '/../../controllers/authors.php';
?>

<?php ob_start(); ?>
<div class="row justify-content-center m-1">
    <div class="card col-md-6">
        <div class="m-4">
            <h1>Crear Autor</h1>
            <form method="POST">
                <?php include '../../templates/alerts.php'; ?><!-- Mensajes de Alertas -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Autor</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <button type="submit" name="create_author" class="btn btn-primary">Crear Autor</button>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>