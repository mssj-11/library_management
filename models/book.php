<!-- models/book.php -->
<?php
require_once __DIR__ . '/../config/constants.php';
require_once(CONFIG_PATH . '/database.php');


// Obtener todos los libros
function listBooks() {
    $db = getPDOConnection();
    //$stmt = $db->query("SELECT * FROM books ORDER BY id DESC");
    $stmt = $db->query("
        SELECT b.id, b.title, a.name AS author, c.name AS genre, b.published_year, b.price, b.quantity, b.image_path
        FROM books b
        JOIN authors a ON b.author_id = a.id
        JOIN categories c ON b.category_id = c.id
        ORDER BY b.id DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener un libro por ID
function getBookById($id) {
    $db = getPDOConnection();
    //$stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
    $stmt = $db->prepare("
        SELECT b.id, b.title, b.author_id, b.category_id, a.name AS author, c.name AS genre, b.published_year, b.price, b.quantity, b.image_path
        FROM books b
        JOIN authors a ON b.author_id = a.id
        JOIN categories c ON b.category_id = c.id
        WHERE b.id = :id
    ");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Crear un nuevo libro
function createBook($title, $authorId, $genreId, $publishedYear, $price, $quantity, $imagePath) {
    $db = getPDOConnection();
    $stmt = $db->prepare(
        "INSERT INTO books (title, author_id, category_id, published_year, price, quantity, image_path) 
         VALUES (:title, :author_id, :category_id, :published_year, :price, :quantity, :image_path)"
    );
    $stmt->execute([
        ':title' => $title,
        ':author_id' => $authorId,
        ':category_id' => $genreId,
        ':published_year' => $publishedYear,
        ':price' => $price,
        ':quantity' => $quantity,
        ':image_path' => $imagePath
    ]);
}


// Actualizar un libro
function updateBook($id, $title, $authorId, $genreId, $publishedYear, $price, $quantity, $imagePath = null) {
    $db = getPDOConnection();
    $sql = "UPDATE books 
            SET title = :title, author_id = :author_id, category_id = :category_id, 
                published_year = :published_year, price = :price, quantity = :quantity";

    if ($imagePath) {
        $sql .= ", image_path = :image_path";
    }

    $sql .= " WHERE id = :id";
    $stmt = $db->prepare($sql);

    $params = [
        ':id' => $id,
        ':title' => $title,
        ':author_id' => $authorId,
        ':category_id' => $genreId,
        ':published_year' => $publishedYear,
        ':price' => $price,
        ':quantity' => $quantity
    ];

    if ($imagePath) {
        $params[':image_path'] = $imagePath;
    }

    $stmt->execute($params);
}


// Eliminar un libro
function deleteBook($id) {
    $db = getPDOConnection();
    $stmt = $db->prepare("DELETE FROM books WHERE id = :id");
    $stmt->execute([':id' => $id]);
}


?>