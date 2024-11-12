<?php
session_start();
// Incluir el archivo de conexión a la base de datos
require_once "../../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario de login
    $usuario = $_POST['usuario'];
    $password = $_POST['clave'];

    // Validar el usuario y contraseña en la base de datos
    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$password'";
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        // Mostrar mensaje de error si la consulta falla
        $error = "Error en la consulta: " . mysqli_error($conexion);
        echo $error;
    } else {
        if (mysqli_num_rows($resultado) == 1) {
            // Iniciar sesión y redirigir al index
            $_SESSION['usuario'] = $usuario;
            header("Location: /AlejoStore/index.php");
            exit;
        } else {

            // Mostrar mensaje de error si las credenciales son incorrectas
            $error = "Usuario o contraseña incorrectos.";
            header("Location: /AlejoStore/login.php?error=$error");

        }
    }
}
?>