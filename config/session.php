<!--        config/session.php        -->
<?php
// Iniciar o reanudar la sesión
session_start();

/**
 * Verifica si el usuario está autenticado.
 * Si no está autenticado, redirige al login.
 */
function checkAuthentication() {
    if (!isset($_SESSION['user'])) {
        header('Location: /library_management/views/auth/login.php');
        exit;
    }
}

/**
 * Redirige al home si el usuario ya está autenticado.
 * Esto se usará en login.php y register.php.
 */
function redirectIfAuthenticated() {
    if (isset($_SESSION['user'])) {
        header('Location: /library_management/public/home.php');
        exit;
    }
}

/**
 * Cierra la sesión actual y redirige al login.
 */
function logout() {
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión

    // Eliminar cookies de sesión si se usan
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, 
            $params["path"], 
            $params["domain"], 
            $params["secure"], 
            $params["httponly"]
        );
    }

    header('Location: /library_management/views/auth/login.php');
    exit;
}


// Maneja el logout si se recibe el parámetro en la URL
if (isset($_GET['logout'])) {
    logout();
}
?>