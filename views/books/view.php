<!-- views/books/view.php -->
<?php
$pageTitle = "Ver Libro";
require_once '../../config/session.php';
require_once __DIR__ . '/../../controllers/books.php';

$id = $_GET['id']; // ID del libro
$book = getBookById($id); // Datos del libro

if (!$book) {
    $_SESSION['error'] = "El libro no existe.";
    header('Location: /library_management/views/books/list.php');
    exit;
}
?>

<?php ob_start(); ?>
<div class="row justify-content-center m-1">
    <div class="card col-md-6">
        <div class="m-4">
            <h1>Detalles del Libro</h1>
            <?php if (!empty($book['image_path'])): ?>
                <div class="mb-3 text-center"><!--
                    <strong>Imagen:</strong>-->
                    <div>
                        <img src="/library_management/<?= htmlspecialchars($book['image_path']); ?>" alt="Imagen del Libro" class="img-fluid img-thumbnail" width="200">
                    </div>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <strong>Título:</strong>
                <p><?= htmlspecialchars($book['title']); ?></p>
            </div>
            <div class="mb-3">
                <strong>Autor:</strong>
                <p><?= htmlspecialchars($book['author']); ?></p>
            </div>
            <div class="mb-3">
                <strong>Género:</strong>
                <p><?= htmlspecialchars($book['genre']); ?></p>
            </div>
            <div class="mb-3">
                <strong>Año de Publicación:</strong>
                <p><?= htmlspecialchars($book['published_year']); ?></p>
            </div>
            <div class="mb-3">
                <strong>Precio:</strong>
                <p>$<?= htmlspecialchars(number_format($book['price'], 2)); ?> MXN</p>
            </div>
            <div class="mb-3">
                <strong>Cantidad Disponible:</strong>
                <p><?= htmlspecialchars($book['quantity']); ?></p>
            </div>
            <div class="text-center">
                <a href="/library_management/views/books/edit.php?id=<?= $book['id']; ?>" class="btn btn-primary">Editar Libro</a>
                <a href="/library_management/views/books/list.php" class="btn btn-secondary">Volver a la Lista</a>
            </div>

        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>