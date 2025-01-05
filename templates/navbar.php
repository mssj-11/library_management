<!-- templates/navbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/library_management/public/home.php">
            <strong>Library</strong><em>Management</em>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Vistas -->
            <ul class="navbar-nav me-auto">
                <?php if (isset($_SESSION['user']['name'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/library_management/views/books/list.php">Libros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/library_management/views/authors/list.php">Autores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/library_management/views/categories/list.php">Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/library_management/views/rentals/list.php">Rentas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/library_management/views/reports/list.php">Reportes</a>
                    </li>
                <?php endif; ?>
            </ul>
            <!-- Perfil Usuario -->
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user']['name'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= htmlspecialchars($_SESSION['user']['name']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="/library_management/views/user/profile.php">Perfil</a></li>
                            <li><a class="dropdown-item" href="/library_management/views/user/settings.php">Configuración</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/library_management/config/session.php?logout=true">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/library_management/views/auth/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/library_management/views/auth/register.php">Registro</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>