<!-- views/books/create.php -->
<?php
$pageTitle = "Crear Libro";
require_once '../../config/session.php';
require_once __DIR__ . '/../../controllers/books.php';
?>

<?php ob_start(); ?>
<div class="row justify-content-center m-1">
    <div class="card col-md-6">
        <div class="m-4">
            <h1>Crear Libro</h1>
            <form method="POST" enctype="multipart/form-data">
                <!-- Mensajes de Alertas -->
                <?php include '../../templates/alerts.php'; ?>
                <div class="form-group mb-3">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($_SESSION['form_data']['title']) ? $_SESSION['form_data']['title'] : ''; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="author_id">Autor</label>
                    <select class="form-control" id="author_id" name="author_id" required>
                        <option value="">Selecciona un autor</option>
                        <?php foreach ($authors as $author): ?>
                            <option value="<?= htmlspecialchars($author['id']); ?>">
                                <?= htmlspecialchars($author['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="category_id">Género</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="">Selecciona un género</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['id']); ?>">
                                <?= htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="published_year">Año de Publicación</label>
                    <input type="number" class="form-control" id="published_year" name="published_year" min="1000" max="<?= date('Y'); ?>" value="<?php echo isset($_SESSION['form_data']['published_year']) ? $_SESSION['form_data']['published_year'] : ''; ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="price">Precio</label>
                    <input type="number" class="form-control" id="price" name="price" min="50" value="<?php echo isset($_SESSION['form_data']['price']) ? $_SESSION['form_data']['price'] : ''; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="quantity">Cantidad</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="<?php echo isset($_SESSION['form_data']['quantity']) ? $_SESSION['form_data']['quantity'] : ''; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="image">Imagen</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" name="create_book" class="btn btn-primary">Crear Libro</button>
                <a href="/library_management/views/books/list.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>