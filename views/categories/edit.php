<!-- views/categories/edit.php -->
<?php
$pageTitle = "Editar Categoría";
require_once '../../config/session.php';
require_once __DIR__ . '/../../controllers/categories.php';

$id = $_GET['id']; // Obtener el ID de la categoría a editar
$category = getCategoryById($id); // Obtener los datos de la categoría

// Verificar si la categoría existe
if (!$category) {
    $_SESSION['error'] = "La categoría no existe.";
    header('Location: /library_management/views/categories/list.php');
    exit;
}
?>


<?php ob_start(); ?>
<div class="row justify-content-center m-1">
    <div class="card col-md-6">
        <div class="m-4">
            <h1>Editar Categoría</h1>
            <form method="POST">
                        <!-- Mensajes de Alertas -->
                        <?php include '../../templates/alerts.php'; ?>
                <input type="hidden" name="id" value="<?= $category['id']; ?>">
                <div class="form-group mb-3">
                    <label for="name">Nombre de la Categoría</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($category['name']); ?>" required>
                </div>
                <button type="submit" name="update_category" class="btn btn-primary">Actualizar Categoría</button>
                <a href="/library_management/views/categories/list.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>