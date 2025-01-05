<!-- views/authors/list.php -->
<?php
$pageTitle = "Lista de Autores";
require_once '../../config/session.php';
require_once __DIR__ . '/../../controllers/authors.php';

$authors = listAuthors(); // Obtener todos los autores
?>

<?php ob_start(); ?>
            <h1>Lista de Autores</h1>
            <a href="/library_management/views/authors/create.php" class="btn btn-primary mt-3 mb-3">Agregar Nuevo Autor</a>
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
                    <?php foreach ($authors as $author): ?>
                        <tr>
                            <td><?= htmlspecialchars($author['name']); ?></td>
                            <td>
                                <a href="/library_management/views/authors/edit.php?id=<?= $author['id']; ?>" class="btn btn-warning">Editar</a>
                                <a href="/library_management/controllers/authors.php?delete=<?= $author['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este autor?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>