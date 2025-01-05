<!-- models/author.php -->
<?php
require_once __DIR__ . '/../config/constants.php';
require_once(CONFIG_PATH . '/database.php');


// Obtiene todos los autores
function getAllAuthors() {
    $db = getPDOConnection();
    //$stmt = $db->query("SELECT * FROM authors");
    $stmt = $db->query("SELECT * FROM authors ORDER BY id DESC"); // Datos en Orden Descendente
    return $stmt->fetchAll();
}

// Obtiene un autor por su ID
function getAuthorById($id) {
    $db = getPDOConnection();
    $stmt = $db->prepare("SELECT * FROM authors WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Crea un nuevo autor
function createAuthor($name) {
    $db = getPDOConnection();
    $stmt = $db->prepare("INSERT INTO authors (name) VALUES (:name)");
    $stmt->execute([':name' => $name]);
}

// Actualiza la información de un autor
function updateAuthor($id, $name) {
    $db = getPDOConnection();
    $stmt = $db->prepare("UPDATE authors SET name = :name WHERE id = :id");
    $stmt->execute([':name' => $name, ':id' => $id]);
}

// Elimina un autor por ID
function deleteAuthor($id) {
    $db = getPDOConnection();
    $stmt = $db->prepare("DELETE FROM authors WHERE id = :id");
    $stmt->execute([':id' => $id]);
}


?>