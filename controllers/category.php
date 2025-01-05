<!-- controllers/category.php -->
<?php
require_once __DIR__ . '/../models/category.php';


// Crear una nueva categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_category'])) {
    $name = trim($_POST['name']);
    if ($name) {
        $success = createCategory($name);
        if ($success) {
            $_SESSION['success'] = "Categoría creada exitosamente.";
        } else {
            $_SESSION['error'] = "La categoría ya existe.";
        }
    } else {
        $_SESSION['error'] = "El nombre de la categoría es obligatorio.";
    }
    header('Location: /library_management/views/categories/list.php');
    exit;
}

// Editar una categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_category'])) {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    if ($name) {
        $success = updateCategory($id, $name);
        if ($success) {
            $_SESSION['success'] = "Categoría actualizada exitosamente.";
        } else {
            $_SESSION['error'] = "La categoría ya existe.";
        }
    } else {
        $_SESSION['error'] = "El nombre de la categoría es obligatorio.";
    }
    header('Location: /library_management/views/categories/edit.php?id=' . $id);
    exit;
}

// Eliminar una categoría
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    deleteCategory($id);
    $_SESSION['success'] = "Categoría eliminada exitosamente.";
    header('Location: /library_management/views/categories/list.php');
    exit;
}

?>