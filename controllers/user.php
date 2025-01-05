<!-- controllers/user.php -->
<?php
require_once __DIR__ . '/../config/constants.php';
require_once(CONFIG_PATH . '/database.php');

// Conexión a la base de datos
$pdo = getPDOConnection();


/**
 * Función para obtener los datos del usuario desde la sesión.
 */
function getUserData() {
    // Retorna todos los datos del usuario, Si no está autenticado, retorna null
    return $_SESSION['user'] ?? null;
}


/**
 * Actualiza los datos del perfil del usuario en la base de datos.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    session_start();

    // Validar si el usuario está autenticado
    if (!isset($_SESSION['user']['user_id'])) {
        $_SESSION['error'] = "No se puede actualizar el perfil. Usuario no autenticado.";
        header('Location: /library_management/views/auth/login.php');
        exit;
    }

    $userId = $_SESSION['user']['user_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if ($name && $email) {
        try {
            // Comprobar si el correo ya está registrado por otro usuario
            $checkQuery = "SELECT id FROM users WHERE email = :email AND id != :id";
            $checkStmt = $pdo->prepare($checkQuery);
            $checkStmt->execute([':email' => $email, ':id' => $userId]);

            if ($checkStmt->rowCount() > 0) {
                $_SESSION['error'] = "El correo electrónico ya está registrado por otro usuario.";
            } else {
                // Actualizar los datos del usuario en la base de datos
                $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':id' => $userId
                ]);

                // Actualizar los datos en la sesión
                $_SESSION['user']['name'] = $name;
                $_SESSION['user']['email'] = $email;

                $_SESSION['success'] = "Perfil actualizado con éxito.";
            }
        } catch (PDOException $e) {
            // Manejo del error sin exponer información sensible
            $_SESSION['error'] = "Error al actualizar el perfil. Por favor, intente más tarde.";
            error_log("Error al actualizar perfil: " . $e->getMessage()); // Registrar el error
        }
    } else {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
    }

    header('Location: /library_management/views/user/profile.php');
    exit;
}


/**
 * Cambia la contraseña del usuario.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    session_start();

    // Validar si el usuario está autenticado
    if (!isset($_SESSION['user']['user_id'])) {
        $_SESSION['error'] = "Usuario no autenticado.";
        header('Location: /library_management/views/auth/login.php');
        exit;
    }

    $userId = $_SESSION['user']['user_id'];
    $currentPassword = trim($_POST['current_password']);
    $newPassword = trim($_POST['new_password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // Validar campos obligatorios
    if (!$currentPassword || !$newPassword || !$confirmPassword) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
    } elseif ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "Las nuevas contraseñas no coinciden.";
    } else {
        try {
            // Verificar la contraseña actual
            $query = "SELECT password FROM users WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':id' => $userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user || !password_verify($currentPassword, $user['password'])) {
                $_SESSION['error'] = "La contraseña actual es incorrecta.";
            } else {
                // Actualizar la contraseña en la base de datos
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE users SET password = :password WHERE id = :id";
                $updateStmt = $pdo->prepare($updateQuery);
                $updateStmt->execute([
                    ':password' => $hashedPassword,
                    ':id' => $userId
                ]);

                $_SESSION['success'] = "Contraseña actualizada con éxito.";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error al actualizar la contraseña. Por favor, intente más tarde.";
            error_log("Error al actualizar la contraseña: " . $e->getMessage());
        }
    }

    header('Location: /library_management/views/user/settings.php');
    exit;
}

?>