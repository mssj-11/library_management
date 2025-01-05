<?php
require_once 'config/constants.php';
require_once CONFIG_PATH . '/session.php';

// Redirigir a login si no hay sesión activa
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . VIEWS_PATH . '/auth/login.php');
    exit;
}

// Página principal después del login
header('Location: ' . VIEWS_PATH . '/home.php');
exit;
?>