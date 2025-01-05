<!-- views/books/edit.php -->
<?php
$pageTitle = "Editar Libro";
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
            <h1>Editar Libro</h1>
            <form method="POST" enctype="multipart/form-data">
                <!-- Mensajes de Alertas -->
                <?php include '../../templates/alerts.php'; ?>
                <input type="hidden" name="id" value="<?= $book['id']; ?>">
                <div class="form-group mb-3">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($book['title']); ?>" required>
                </div>
                <!-- Autor -->
                <div class="form-group mb-3">
                    <label for="author_id">Autor</label>
                    <select class="form-control" id="author_id" name="author_id" required>
                        <?php foreach ($authors as $author): ?>
                            <option value="<?= $author['id']; ?>" <?= $author['id'] == $book['author_id'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($author['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Género -->
                <div class="form-group mb-3">
                    <label for="category_id">Género</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id']; ?>" <?= $category['id'] == $book['category_id'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="published_year">Año de Publicación</label>
                    <input type="number" class="form-control" id="published_year" name="published_year" min="1000" max="<?= date('Y'); ?>" value="<?= $book['published_year']; ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="price">Precio</label>
                    <input type="number" class="form-control" id="price" name="price" min="50" value="<?= $book['price']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="quantity">Cantidad</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="<?= $book['quantity']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="image">Imagen</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <?php if ($book['image_path']): ?>
                        <img src="/library_management/<?= htmlspecialchars($book['image_path']); ?>" alt="Imagen del Libro" class="mt-3 img-thumbnail" width="150">
                    <?php endif; ?>
                </div>
                <button type="submit" name="update_book" class="btn btn-primary">Actualizar Libro</button>
                <a href="/library_management/views/books/list.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>