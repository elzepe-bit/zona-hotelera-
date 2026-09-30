<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reservaciones</title>
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
  <a href="huespedes.php">Huéspedes</a>
  <a href="reservaciones.php" class="active">Reservaciones</a>

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
    <h2>Registrar Reservación</h2>

    <input type="text" placeholder="Nombre del huésped">
    <input type="text" placeholder="Número de habitación">
    <label>Fecha de entrada</label>
    <input type="date">
    <label>Fecha de salida</label>
    <input type="date">

    <button>Registrar</button>
  </div>
</main>

</body>
</html>
