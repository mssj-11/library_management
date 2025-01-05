#   Sistema de Gestión de Biblioteca
**Descripción:**
Sistema Web de Registro y préstamo de libros.

**Características clave:**

*   Búsqueda de libros por autor, título o género.
*   Reportes en PDF/Excel: libros prestados, libros disponibles.
*   Sistema de reservas online.
*   Dashboard interactivo con Bootstrap.


##  Estructura de Archivos y Carpetas

```
library_management/
├── config/
│   ├── database.php              # Configuración de la base de datos
│   ├── constants.php             # Constantes globales
│   └── session.php               # Manejo de sesiones
├── controllers/
│   ├── auth.php                  # Controlador para login y registro
│   ├── user.php                  # Controlador actualizar datos del usuario
│   ├── books.php                 # Controlador para CRUD de libros
│   ├── authors.php               # Controlador para CRUD de autores
│   ├── categories.php            # Controlador para CRUD de categorías
│   ├── rentals.php               # Controlador para CRUD de rentas
│   └── reports.php               # Controlador para generar reportes PDF y Excel
├── models/
│   ├── user.php                  # Modelo de usuarios
│   ├── book.php                  # Modelo de libros
│   ├── author.php                # Modelo de autores
│   ├── category.php              # Modelo de categorías
│   └── rental.php                # Modelo de rentas
├── templates/
│   ├── alerts.php                # Plantilla de mensajes
│   ├── navbar.php                # Plantilla del navbar
│   ├── footer.php                # Plantilla del footer
│   ├── layout.php                # Plantilla principal
├── public/
│   ├── css/
│   │   └── styles.css            # Estilos personalizados
│   ├── js/
│   │   └── scripts.js            # Scripts personalizados
│   └── home.php                  # Página principal (Home)
├── views/
│   ├── auth/
│   │   ├── login.php             # Vista de login
│   │   └── register.php          # Vista de registro
│   ├── user/
│   │   ├── profile.php           # Vista con Formulario para editar datos de usuario
│   │   └── settings.php          # Vista con Formulario para editar la contraseña
│   ├── books/
│   │   ├── create.php            # Formulario para agregar libros
│   │   ├── list.php              # Listado de libros
│   │   ├── edit.php              # Formulario para editar libros
│   │   ├── view.php              # Ver datos del libro
│   ├── authors/
│   │   ├── create.php            # Formulario para agregar autores
│   │   ├── list.php              # Listado de autores
│   │   ├── edit.php              # Formulario para editar autores
│   ├── categories/
│   │   ├── create.php            # Formulario para agregar categorías
│   │   ├── list.php              # Listado de categorías
│   │   ├── edit.php              # Formulario para editar categorías
│   ├── rentals/
│   │   ├── create.php            # Formulario para registrar una renta
│   │   ├── list.php              # Listado de rentas
│   │   ├── edit.php              # Formulario para editar rentas
│   └── errors/
│       └── 404.php               # Página de error 404
├── storage/
│   ├── reports/
│   │   └── example_report.pdf    # Carpeta para guardar reportes generados
│   ├── img_books/                # Carpeta para subir imágenes de libros
├── fpdf/
│   └── fpdf.php                  # Biblioteca FPDF para reportes en PDF
├── index.php                     # Configuración para rutas amigables
├── .htaccess                     # Configuración para rutas amigables
└── README.md                     # Descripción del proyecto

```


