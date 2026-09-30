<?php
// 1. IMPORTAMOS PHPMAILER (Esto debe ir siempre hasta arriba)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Asegúrate de que la carpeta PHPMailer esté en la misma ruta que este archivo
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

session_start();
include "../bd/conexion.php";

/* =====================
   LOGIN (Con Roles y validación de Correo/Usuario)
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'login') {

  $identificador = $conn->real_escape_string($_POST['usuario']);
  $password = $conn->real_escape_string($_POST['password']);
  $password_md5 = md5($password);

  $sql = $conn->query("
    SELECT p.*, r.nombre_rol 
    FROM persona p
    INNER JOIN roles r ON p.id_rol = r.id_rol
    WHERE (p.Usuario='$identificador' OR p.Correo='$identificador') 
    AND p.Password='$password_md5'
    LIMIT 1
  ");

   if ($sql->num_rows === 1) {
    $row = $sql->fetch_assoc();

    $_SESSION['usuario'] = $row['Usuario'];
    $_SESSION['nombre']  = $row['Nombre'];
    $_SESSION['rol']     = $row['nombre_rol'];

    echo $row['nombre_rol'];
  } else {
    echo "error";
  }
  exit;
}

/* =====================
   REGISTRO
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'registro') {

  $nombre     = $conn->real_escape_string($_POST['nombre']);
  $ap         = $conn->real_escape_string($_POST['ap']);
  $am         = $conn->real_escape_string($_POST['am']);
  $usuario    = $conn->real_escape_string($_POST['usuario']);
  $correo     = $conn->real_escape_string($_POST['correo']);
  $direccion  = $conn->real_escape_string($_POST['direccion']);
  $telefono   = $conn->real_escape_string($_POST['telefono']);
  $password   = $conn->real_escape_string($_POST['password']);
  $password_md5 = md5($password);

  $conn->query("
    INSERT INTO persona
    (Nombre, A_Paterno, A_Materno, Usuario, Correo, Direccion, Telefono, Password)
    VALUES
    ('$nombre','$ap','$am','$usuario','$correo','$direccion','$telefono','$password_md5')
  ");

  echo "ok";
  exit;
}

/* =====================
   PASO 1: SOLICITAR CORREO (PHPMAILER REAL)
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'solicitar_correo') {
    
    $correo = $conn->real_escape_string($_POST['correo']);
    $verificar = $conn->query("SELECT * FROM persona WHERE Correo='$correo'");

    if ($verificar->num_rows > 0) {
        // Generamos token y lo guardamos
        $token = bin2hex(random_bytes(25)); 
        $conn->query("UPDATE persona SET token_recuperacion='$token' WHERE Correo='$correo'");
        
        // ⚠️ IMPORTANTE: Verifica que esta ruta sea la correcta a tu proyecto
        $enlace = "http://localhost/zepe-prueba/zona-hotelera/restablecer.php?token=" . $token;

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            
            // TUS CREDENCIALES
            $mail->Username   = 'angelzepeda965@gmail.com'; 
            $mail->Password   = 'unnijbcxqvvykpdn';    
            
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('angelzepeda965@gmail.com', 'Sistema Zona Hotelera');
            $mail->addAddress($correo); 

            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de Contraseña - Zona Hotelera';
            $mail->Body    = "
                <h2>Recuperación de Contraseña</h2>
                <p>Hola, hemos recibido una solicitud para cambiar tu clave de acceso en el Sistema Zona Hotelera.</p>
                <p>Haz clic en el siguiente enlace para crear una nueva contraseña:</p>
                <br>
                <a href='{$enlace}' style='background:#2563eb; color:white; padding:12px 20px; text-decoration:none; border-radius:8px; font-weight:bold;'>Restablecer Contraseña</a>
                <br><br>
                <p>Si el botón no funciona, copia y pega este enlace en tu navegador:</p>
                <p>{$enlace}</p>
            ";

            $mail->SMTPOptions = [
  'ssl' => [
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
  ]
];

            $mail->send();
            echo "ok";
        } catch (Exception $e) {
            echo "error_correo: {$mail->ErrorInfo}";
        }
    } else {
        echo "error_no_existe"; 
    }
    exit;
}

/* =====================
   PASO 2: GUARDAR NUEVA CONTRASEÑA (FINAL)
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'guardar_nueva_pass') {
    
    $token = $conn->real_escape_string($_POST['token']);
    $password = $conn->real_escape_string($_POST['password']);
    $password_md5 = md5($password);

    // Actualizamos y borramos el token por seguridad
    $sql = "UPDATE persona SET Password='$password_md5', token_recuperacion=NULL 
            WHERE token_recuperacion='$token'";
    
    if ($conn->query($sql)) {
        echo "ok";
    } else {
        echo "error";
    }
    exit;
}

/* =====================
   ACCESO DIRECTO
===================== */
http_response_code(400);
echo "Acceso no permitido";
?>