<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="body-login-unica"> <div class="login-screen">

<header class="header">
  <h1>Sistema Zona Hotelera</h1>
  <p>Iniciar sesión</p>
</header>

<main class="container">
  <div class="card" style="max-width:400px;margin:auto;">
    <h2>Acceso</h2>

  <form id="formLogin">
      <input type="text" id="usuario" placeholder="Usuario o correo" required>
      <input type="password" id="password" placeholder="Contraseña" required>
      
      <div style="text-align: right; margin-top: -5px; margin-bottom: 15px;">
        <a href="recuperar.php" class="link-recuperar">¿Olvidaste tu contraseña?</a>
      </div>
      
      <div class="botones-group">
        <button type="submit">Ingresar</button>
        <a href="index.php" class="btn-regresar">Regresar</a>
      </div>
    </form>

    <p style="text-align:center;margin-top:20px;">
      ¿No tienes cuenta?
      <a href="registro.php" style="color:#2563eb;font-weight:600;">
        Regístrate
      </a>
    </p>
  </div>
</main>

<script src="js/login.js"></script>
</body>
</html>
