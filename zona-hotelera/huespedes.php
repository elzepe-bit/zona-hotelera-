<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Huéspedes</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<header class="header">
  <h1>Sistema Zona Hotelera</h1>
  <p>Gestión de habitaciones, huéspedes y reservaciones</p>
</header>

<nav class="nav">
  <a href="index.php">Inicio</a>
  <a href="habitaciones.php">Habitaciones</a>
  <a href="huespedes.php" class="active">Huéspedes</a>
  <a href="reservaciones.php">Reservaciones</a>

  <?php if (isset($_SESSION['usuario'])): ?>
    <div class="usuario-box">
      👤 <?php echo $_SESSION['nombre']; ?>
      <span class="badge-rol">
        (<?php echo ucfirst($_SESSION['rol']); ?>)
      </span>
      <a href="logout.php" class="logout">Cerrar sesión</a>
    </div>
  <?php else: ?>
    <a href="login.php" class="btn-login">Iniciar sesión</a>
  <?php endif; ?>
</nav>
<main class="container">

  <div class="card">
    <h2>Registro de Huéspedes</h2>

    <form id="formHuesped">
      <input type="hidden" id="id">
      <input type="text" id="nombre" placeholder="Nombre completo" required>
      <input type="email" id="correo" placeholder="Correo" required>
      <input type="tel" id="telefono" placeholder="Teléfono" required>
      <button type="submit" id="btnGuardar">Guardar</button>

    </form>
  </div>

  <div class="card">
    <h2>Huéspedes Registrados</h2>

    <input 
  type="text" 
  id="buscador" 
  placeholder="Buscar huésped por nombre, correo o teléfono..."
  class="buscador"
>

  <table class="tabla">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Teléfono</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody id="tablaHuespedes"></tbody>
</table>

  </div>

</main>

<script src="js/huespedes.js"></script>
</body>


</html>
