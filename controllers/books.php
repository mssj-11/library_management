<!-- controllers/books.php -->
<?php
require_once __DIR__ . '/../models/book.php';
require_once __DIR__ . '/../models/author.php';
require_once __DIR__ . '/../models/category.php';


$books = listBooks(); // Obtiene todos los libros
$authors = getAllAuthors(); // Obtiene todos los autores
$categories = getAllCategories(); // Obtiene todas las categorías


// Función personalizada para verificar si ya existe un libro con el mismo título y autor
function checkBookExistence($title, $authorId, $excludeId = null) {
    $query = "SELECT 1 FROM books WHERE title = :title AND author_id = :author_id";
    
    // Excluir el libro actual si estamos actualizando
    if ($excludeId) {
        $query .= " AND id != :exclude_id";
    }

    $pdo = getPDOConnection();
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author_id', $authorId);
    
    if ($excludeId) {
        $stmt->bindParam(':exclude_id', $excludeId);
    }

    $stmt->execute();
    return $stmt->fetchColumn() !== false;
}

// Función para validar el tamaño del archivo imagen
function validateImageSize($file)
{
    if ($file['size'] > 2 * 1024 * 1024) { // 2MB
        $_SESSION['error'] = "El archivo es demasiado grande. Tamaño máximo: 2MB.";
        header('Location: /library_management/views/books/list.php');
        exit;
    }
}

// Función para eliminar la imagen cargada si ocurre un error
function deleteUploadedImageOnError($imagePath) {
    if (isset($imagePath) && file_exists(__DIR__ . '/../' . $imagePath)) {
        unlink(__DIR__ . '/../' . $imagePath); // Eliminar imagen subida
    }
}


// Crear un nuevo libro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_book'])) {
    $title = trim($_POST['title']);
    $authorId = trim($_POST['author_id']);
    $genreId = trim($_POST['category_id']);
    $publishedYear = intval($_POST['published_year']);
    $price = intval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    // Guardar los datos del formulario en la sesión
    $_SESSION['form_data'] = $_POST;

    // Manejo de la imagen
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        validateImageSize($_FILES['image']); // Validar tamaño del archivo
        $imagePath = 'storage/img_books/' . uniqid() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../' . $imagePath);
    }

    if ($title && $authorId && $genreId && $publishedYear && $price && $quantity > 0) {
        try {
            // Verificar si el libro ya existe con el mismo título y autor
            $bookExist = checkBookExistence($title, $authorId); // Función personalizada que verifica la existencia del libro
            if ($bookExist) {
                $_SESSION['error'] = "Ya existe un libro con el mismo título y autor.";
                // Llamada a la función para eliminar la imagen en caso de error
                deleteUploadedImageOnError($imagePath);
                // Mantenerse en el formulario de creación
                header('Location: /library_management/views/books/create.php');
                exit;
            } else {
                createBook($title, $authorId, $genreId, $publishedYear, $price, $quantity, $imagePath);
                $_SESSION['success'] = "Libro creado exitosamente.";
                unset($_SESSION['form_data']); // Limpiar los datos del formulario al crear el libro
                //  Redirigir a la vista de Lista Libros
                header('Location: /library_management/views/books/list.php');
                exit;
            }
        } catch (PDOException $e) {
            // Verifica si el error es por duplicidad del libro
            if ($e->getCode() === '23000') {
                $_SESSION['error'] = "El libro ya existe.";
                // Llamada a la función para eliminar la imagen en caso de error
                deleteUploadedImageOnError($imagePath);
                // Mantenerse en el formulario de creación
                header('Location: /library_management/views/books/create.php');
                exit;
            } else {
                $_SESSION['error'] = "Error al crear el libro: " . $e->getMessage();
                // Llamada a la función para eliminar la imagen en caso de error
                deleteUploadedImageOnError($imagePath);
                // Mantenerse en el formulario de creación
                header('Location: /library_management/views/books/create.php');
                exit;
            }
            //$_SESSION['error'] = "Error al crear el libro: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        // Llamada a la función para eliminar la imagen en caso de error
        deleteUploadedImageOnError($imagePath);
        // Mantenerse en el formulario de creación
        header('Location: /library_management/views/books/create.php');
        exit;
    }
}

// Actualizar un libro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_book'])) {
    $id = intval($_POST['id']);
    $title = trim($_POST['title']);
    $authorId = trim($_POST['author_id']);
    $genreId = trim($_POST['category_id']);
    $publishedYear = intval($_POST['published_year']);
    $price = intval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    // Manejo de la imagen
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        validateImageSize($_FILES['image']); // Validar tamaño del archivo
        $imagePath = 'storage/img_books/' . uniqid() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../' . $imagePath);
    }

    if ($id && $title && $authorId && $genreId && $publishedYear && $price && $quantity > 0) {
        try {
            // Verificar si el libro ya existe con el mismo título y autor, excluyendo el libro que estamos actualizando
            $bookExist = checkBookExistence($title, $authorId, $id); // La función ahora recibe el ID para excluirlo
            if ($bookExist) {
                $_SESSION['error'] = "Ya existe un libro con el mismo título y autor.";
                // Llamada a la función para eliminar la imagen en caso de error
                deleteUploadedImageOnError($imagePath);
            } else {
                // Si se está actualizando la imagen, obtenemos la imagen actual para eliminarla si es necesario
                $existingBook = getBookById($id); // Asumimos que esta función te devuelve los datos del libro
                $oldImagePath = $existingBook['image_path']; // Obtener la imagen antigua

                // Actualizar datos del libro
                updateBook($id, $title, $authorId, $genreId, $publishedYear, $price, $quantity, $imagePath);

                // Eliminar la imagen anterior si se ha actualizado la imagen
                if ($imagePath && file_exists(__DIR__ . '/../' . $oldImagePath)) {
                    unlink(__DIR__ . '/../' . $oldImagePath); // Eliminar la imagen anterior
                }
                // Mensaje de actualizacion con exito
                $_SESSION['success'] = "Libro actualizado exitosamente.";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error al actualizar el libro: " . $e->getMessage();
            deleteUploadedImageOnError($imagePath); // Llamada a la función para eliminar la imagen en caso de error
        }
    } else {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        deleteUploadedImageOnError($imagePath); // Llamada a la función para eliminar la imagen en caso de error
    }

    header('Location: /library_management/views/books/list.php');
    exit;
}


// Eliminar un libro
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if ($id) {
        try {
            // Obtén la ruta de la imagen desde la base de datos
            $book = getBookById($id);
            if ($book && isset($book['image_path'])) {
                $imagePath = __DIR__ . '/../' . $book['image_path'];
                // Verifica si el archivo existe y lo elimina
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            // Finalmente elimina el registro del libro
            deleteBook($id);
            $_SESSION['success'] = "Libro eliminado exitosamente.";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error al eliminar el libro: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "ID inválido.";
    }

    header('Location: /library_management/views/books/list.php');
    exit;
}


?>