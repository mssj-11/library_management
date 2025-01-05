<!-- views/categories/list.php -->
<?php
$pageTitle = "Lista de Categorías";
require_once '../../config/session.php';
require_once __DIR__ . '/../../controllers/categories.php';

$categories = getAllCategories(); // Obtener todas las categorías
?>

<?php ob_start(); ?>
    <h1>Lista de Categorías</h1>
    <a href="/library_management/views/categories/create.php" class="btn btn-primary">Agregar Nueva Categoría</a>
    <!-- Mensajes de Alertas -->
    <?php include '../../templates/alerts.php'; ?>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= htmlspecialchars($category['name']); ?></td>
                    <td>
                        <a href="/library_management/views/categories/edit.php?id=<?= $category['id']; ?>" class="btn btn-warning">Editar</a>
                        <a href="/library_management/controllers/category.php?delete=<?= $category['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>