<?php
include "../bd/conexion.php";

// 1. Capturamos el token secreto que viene en la URL
$token = isset($_GET['token']) ? $conn->real_escape_string($_GET['token']) : '';

// 2. Buscamos en la base de datos si alguien tiene ese token asignado
$sql = "SELECT * FROM persona WHERE token_recuperacion = '$token' AND token_recuperacion IS NOT NULL";
$resultado = $conn->query($sql);

// Si encuentra 1 fila, significa que el token es válido y verdadero
$usuario_valido = ($resultado->num_rows > 0);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Contraseña</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="body-login-unica">
    <div class="login-screen">
        <header class="header">
            <h1>Sistema Zona Hotelera</h1>
        </header>

        <main class="container">
            <div class="card" style="max-width:400px;margin:auto;">
                
                <?php if ($usuario_valido): ?>
                    <h2>Crear nueva contraseña</h2>
                    <p style="font-size:14px; color:#475569; margin-bottom:15px;">Ingresa tu nueva clave de acceso.</p>
                    
                    <form id="formRestablecer">
                        <input type="hidden" id="tokenReset" value="<?php echo $token; ?>">
                        
                        <input type="password" id="pass1" placeholder="Nueva contraseña" required style="margin-bottom: 10px;">
                        <input type="password" id="pass2" placeholder="Confirmar contraseña" required>
                        
                        <div class="botones-group" style="margin-top: 15px;">
                            <button type="submit">Guardar Contraseña</button>
                        </div>
                    </form>
                
                <?php else: ?>
                    <h2 style="color:#ef4444;">Enlace inválido</h2>
                    <p>El enlace de recuperación ha expirado, es incorrecto o ya fue utilizado por seguridad.</p>
                    <br>
                    <a href="login.php" class="btn-regresar">Volver al Login</a>
                <?php endif; ?>

            </div>
        </main>
    </div>
    
    <script src="js/restablecer.js"></script>
</body>
</html>