<!-- views/books/list.php -->
<?php
$pageTitle = "Lista de Libros";
require_once '../../config/session.php';
require_once __DIR__ . '/../../controllers/books.php';
?>


<?php ob_start(); ?>
<div class="container">
    <h1 class="mt-4">Lista de Libros</h1>
    <!-- Mensajes de Alertas -->
    <?php include '../../templates/alerts.php'; ?>
    <a href="/library_management/views/books/create.php" class="btn btn-primary mb-3">Agregar Libro</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Género</th>
                <th>Año/Publicación</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= $book['id']; ?></td>
                    <td><?= $book['title']; ?></td>
                    <td><?= htmlspecialchars($book['author']); ?></td>
                    <td><?= htmlspecialchars($book['genre']); ?></td>
                    <td><?= $book['published_year']; ?></td>
                    <td>$<?= $book['price']; ?> MXN</td>
                    <td><?= $book['quantity']; ?></td>
                    <td>
                        <?php if ($book['image_path']): ?>
                            <img src="/library_management/<?= htmlspecialchars($book['image_path']); ?>" alt="Imagen del Libro" width="50">
                        <?php else: ?>
                            No disponible
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="/library_management/views/books/view.php?id=<?= $book['id']; ?>" class="btn btn-sm btn-info">Ver</a>
                        <a href="/library_management/views/books/edit.php?id=<?= $book['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="/library_management/views/books/list.php?delete=<?= $book['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este libro?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>