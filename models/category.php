<!-- models/category.php -->
<?php
require_once __DIR__ . '/../config/constants.php';
require_once(CONFIG_PATH . '/database.php');


// Obtiene todas las categorías
function getAllCategories() {
    $db = getPDOConnection();
    $stmt = $db->query("SELECT * FROM categories ORDER BY id DESC"); // Orden descendente por id
    return $stmt->fetchAll();
}

// Obtiene una categoría por su ID
function getCategoryById($id) {
    $db = getPDOConnection();
    $stmt = $db->prepare("SELECT * FROM categories WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Verifica si una categoría existe por nombre
function categoryExists($name) {
    $db = getPDOConnection();
    $stmt = $db->prepare("SELECT COUNT(*) FROM categories WHERE name = :name");
    $stmt->execute([':name' => $name]);
    return $stmt->fetchColumn() > 0; // Retorna verdadero si la categoría ya existe
}

// Crea una nueva categoría
function createCategory($name) {
    if (categoryExists($name)) {
        return false; // Retorna falso si la categoría ya existe
    }

    $db = getPDOConnection();
    $stmt = $db->prepare("INSERT INTO categories (name) VALUES (:name)");
    $stmt->execute([':name' => $name]);
    return true; // Retorna verdadero si la creación fue exitosa
}

// Actualiza una categoría existente
function updateCategory($id, $name) {
    if (categoryExists($name)) {
        return false; // Retorna falso si la categoría ya existe
    }

    $db = getPDOConnection();
    $stmt = $db->prepare("UPDATE categories SET name = :name WHERE id = :id");
    $stmt->execute([':name' => $name, ':id' => $id]);
    return true; // Retorna verdadero si la actualización fue exitosa
}

// Elimina una categoría por ID
function deleteCategory($id) {
    $db = getPDOConnection();
    $stmt = $db->prepare("DELETE FROM categories WHERE id = :id");
    $stmt->execute([':id' => $id]);
}
?>