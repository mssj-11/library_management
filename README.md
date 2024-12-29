#   Sistema de Gestión de Biblioteca
**Descripción:**
Sistema Web de Registro y préstamo de libros.

**Características clave:**

*   Búsqueda de libros por autor, título o género.
*   Reportes en PDF/Excel: libros prestados, libros disponibles.
*   Sistema de reservas online.
*   Dashboard interactivo con Bootstrap.


##  Estructura de Archivos y Carpetas

```sh
library_management/
├── config/
│   ├── database.php              # Configuración de la base de datos
│   ├── constants.php             # Constantes globales
│   └── session.php               # Manejo de sesiones
├── controllers/
│   ├── auth.php                  # Controlador para login y registro
│   ├── books.php                 # Controlador para CRUD de libros
│   └── contact.php               # Controlador para formulario de contacto
├── models/
│   ├── user.php                  # Modelo de usuarios
│   ├── book.php                  # Modelo de libros
│   └── contact.php               # Modelo de contacto
├── templates/
│   ├── navbar.php                # Plantilla del navbar
│   ├── footer.php                # Plantilla del footer
│   ├── layout.php                # Plantilla principal
├── public/
│   ├── css/
│   │   └── styles.css            # Estilos personalizados
│   ├── js/
│   │   └── scripts.js            # Scripts personalizados
│   └── index.php                 # Página principal (Home)
├── views/
│   ├── auth/
│   │   ├── login.php             # Vista de login
│   │   └── register.php          # Vista de registro
│   ├── books/
│   │   ├── list.php              # Listado de libros
│   │   ├── create.php            # Formulario para agregar libros
│   │   └── edit.php              # Formulario para editar libros
│   ├── contact/
│   │   └── form.php              # Vista del formulario de contacto
│   └── errors/
│       └── 404.php               # Página de error 404
├── storage/
│   ├── reports/
│   │   └── example_report.pdf    # Carpeta para guardar reportes generados
│   └── uploads/                  # Carpeta para subir archivos (si es necesario)
├── fpdf/
│   └── fpdf.php                  # Biblioteca FPDF
├── .htaccess                     # Configuración para rutas amigables
└── README.md                     # Descripción del proyecto
```


