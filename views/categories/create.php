<!-- views/categories/create.php -->
<?php
$pageTitle = "Crear Categoría";
require_once '../../config/session.php';
require_once __DIR__ . '/../../controllers/categories.php';
?>


<?php ob_start(); ?>

<div class="row justify-content-center m-1">
    <div class="card col-md-6">
        <div class="m-4">
            <h1>Crear Nueva Categoría</h1>
            <form method="POST">
                <!-- Mensajes de Alertas -->
                <?php include '../../templates/alerts.php'; ?>
                <div class="form-group">
                    <label for="name">Nombre de la Categoría</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <button type="submit" name="create_category" class="btn btn-primary mt-3">Crear</button>
                <a href="/library_management/views/categories/list.php" class="btn btn-secondary mt-3">Volver</a>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>