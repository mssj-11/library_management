<!--        config/database.php        -->
<?php
//  Función para la conexión a la Base de Datos
function getPDOConnection() {
    // Configura los datos de la base de datos
    $host = 'localhost';
    $dbname = 'library_management';
    $username = 'root';
    $password = '';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Error al conectar con la base de datos: " . $e->getMessage());
    }

}
?>