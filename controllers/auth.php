<!-- controllers/auth.php -->
<?php
require_once __DIR__ . '/../config/constants.php'; //require_once '../config/constants.php';
require_once(CONFIG_PATH . '/database.php'); //require_once '../config/database.php';

$error = null;
$success = null;

// Obtén la conexión PDO a la base de datos
$pdo = getPDOConnection(); // Llama a la función para obtener la conexión

// Manejo de registro de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT); // Codificar la contraseña

    if ($name && $email && $password) {
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
            $success = "Registro exitoso. Por favor, inicia sesión.";
        } catch (PDOException $e) {
            $error = "Error al registrar: " . ($e->getCode() == 23000 ? "Correo ya registrado." : $e->getMessage());
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}

// Manejo de login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email && $password) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                //$_SESSION['user'] = $user['name'];
                // Almacenar la información del usuario en la sesión
                $_SESSION['user'] = [
                    'user_id' => $user['id'], // Asumimos que la tabla `users` tiene un campo `id`
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => $user['password'] // No es recomendable guardar la contraseña en la sesión por razones de seguridad
                ];
                header('Location: /library_management/public/home.php');
                exit;
            } else {
                $error = "Correo o contraseña incorrectos.";
            }
        } catch (PDOException $e) {
            $error = "Error al iniciar sesión: " . $e->getMessage();
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}

// Manejo de logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /views/auth/login.php');
    exit;
}
?>