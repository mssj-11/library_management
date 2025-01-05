<!-- views/authors/edit.php -->
<?php
$pageTitle = "Editar Autor";
require_once '../../config/session.php';
require_once __DIR__ . '/../../controllers/authors.php';

if (!isset($_GET['id'])) {
    header('Location: /library_management/views/authors/list.php');
    exit;
}

$authorId = $_GET['id'];
$author = getAuthorById($authorId);

if (!$author) {
    header('Location: /library_management/views/authors/list.php');
    exit;
}
?>

<?php ob_start(); ?>
<div class="row justify-content-center m-1">
    <div class="card col-md-6">
        <div class="m-4">
            <h1>Editar Autor</h1>
            <form method="POST">
                <input type="hidden" name="id" value="<?= $author['id']; ?>">
                <?php include '../../templates/alerts.php'; ?><!-- Mensajes de Alertas -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Autor</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($author['name']); ?>" required>
                </div>
                <button type="submit" name="update_author" class="btn btn-primary">Actualizar Autor</button>
                <a class="btn btn-dark" href="/library_management/views/authors/list.php">Cancelar</a>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include '../../templates/layout.php'; ?>