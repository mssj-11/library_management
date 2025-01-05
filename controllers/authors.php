<!-- controllers/authors.php -->
<?php
require_once __DIR__ . '/../models/author.php';

// Listar todos los autores
function listAuthors() {
    $authors = getAllAuthors();
    return $authors;
}

// Crear un nuevo autor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_author'])) {
    $name = trim($_POST['name']);
    if ($name) {
        try {
            createAuthor($name); // Asumiendo que esta función maneja la inserción en la base de datos
            $_SESSION['success'] = "Autor creado exitosamente.";
        } catch (PDOException $e) {
            // Verifica si el error es por duplicidad de autor
            if ($e->getCode() === '23000') { // Código de error de duplicado en MySQL
                $_SESSION['error'] = "El autor ya existe.";
            } else {
                $_SESSION['error'] = "Ocurrió un error al crear el autor.";
            }
        }
    } else {
        $_SESSION['error'] = "El nombre del autor es obligatorio.";
    }
    header('Location: /library_management/views/authors/list.php');
    exit;
}

// Editar un autor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_author'])) {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    if ($name) {
        try {
            updateAuthor($id, $name); // Asumiendo que esta función maneja la actualización en la base de datos
            $_SESSION['success'] = "Autor actualizado exitosamente.";
        } catch (PDOException $e) {
            // Verifica si el error es por duplicidad de autor
            if ($e->getCode() === '23000') { // Código de error de duplicado en MySQL
                $_SESSION['error'] = "El autor ya existe.";
            } else {
                $_SESSION['error'] = "Ocurrió un error al actualizar el autor.";
            }
        }
    } else {
        $_SESSION['error'] = "El nombre del autor es obligatorio.";
    }
    header('Location: /library_management/views/authors/edit.php?id=' . $id);
    exit;
}


// Eliminar un autor
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $id = $_GET['delete'];
    deleteAuthor($id);
    $_SESSION['success'] = "Autor eliminado exitosamente.";
    header('Location: /library_management/views/authors/list.php');
    exit;
}
?>