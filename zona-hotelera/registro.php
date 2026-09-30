<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="body-registro-unica">

<header class="header">
  <h1>Sistema Zona Hotelera</h1>
  <p>Crear cuenta</p>
</header>

<main class="container">

  <div class="card" style="max-width:500px;margin:auto;">


    <form id="formRegistro">
      <input type="text" id="nombre" placeholder="Nombre" required>
      <input type="text" id="ap" placeholder="Apellido paterno" required>
      <input type="text" id="am" placeholder="Apellido materno" required>

      <input type="text" id="usuarioR" placeholder="Usuario" required>
      <input type="email" id="correo" placeholder="Correo" required>

      <input type="text" id="direccion" placeholder="Dirección">
      <input type="tel" id="telefono" placeholder="Teléfono">

      <input type="password" id="passwordR" placeholder="Contraseña" required>
      <button>Registrar</button>
    </form>

    <p style="text-align:center;margin-top:15px;">
      ¿Ya tienes cuenta?
      <a href="login.php" style="color:#2563eb;font-weight:600;">
        Inicia sesión
      </a>
    </p>
  </div>

</main>

<script src="js/registro.js"></script>
</body>
</html>
