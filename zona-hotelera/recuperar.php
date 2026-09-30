<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Recuperar Contraseña</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="body-login-unica"> 
  <div class="login-screen">

    <header class="header">
      <h1>Sistema Zona Hotelera</h1>
      <p>Restablecer contraseña</p>
    </header>

    <main class="container">
      <div class="card" style="max-width:400px;margin:auto;">
        <h2>Recuperar Acceso</h2>
        <p style="font-size: 14px; color: #475569; margin-bottom: 20px;">
          Ingresa el correo electrónico asociado a tu cuenta. Te enviaremos un enlace seguro para crear una nueva contraseña.
        </p>

        <form id="formRecuperar">
          <input type="email" id="correoRecuperar" placeholder="Tu correo electrónico" required>
          
          <div class="botones-group">
            <button type="submit">Enviar Enlace</button>
            <a href="login.php" class="btn-regresar">Cancelar</a>
          </div>
        </form>

      </div>
    </main>

    <script src="js/recuperar.js"></script>
  </div>
</body>
</html>