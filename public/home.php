<!-- public/home.php -->
<?php
$pageTitle = "Home";
require_once '../config/session.php';
checkAuthentication(); // Verifica si el usuario está autenticado
?>

<?php ob_start(); ?>
    <!-- Hero -->
    <header class="hero bg-primary text-white text-center position-relative" style="background: url('img/hero.jpg') no-repeat center center/cover; height: 500px;">
        <!-- Capa negra con opacidad -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.6);"></div>
        <div class="container d-flex flex-column justify-content-center align-items-center h-100 position-relative">
            <h1>Bienvenido <b><?= $_SESSION['user']['name']; ?></b>, al Sistema de Gestión de Biblioteca</h1>
            <p class="lead">Administra tu biblioteca de manera eficiente.</p>
            <a href="/library_management/views/books/list.php" class="btn btn-light btn-lg">Comienza ya!</a>
        </div>
    </header>
<?php $content = ob_get_clean(); ?>
<?php include '../templates/layout.php'; ?>