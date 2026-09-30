<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Zepeda - Inicio</title>
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header class="header">
  <h1>Sistema Zona Hotelera</h1>
  <p>Gestión de habitaciones, huéspedes y reservaciones</p>
</header>

<nav class="nav">
  <a href="index.php" class="active">Inicio</a>
  
  <div class="dropdown">
    <a href="#" class="dropbtn">Gestión <i class="fa fa-caret-down"></i></a>
    <div class="dropdown-content">
      <a href="habitaciones.php">Habitaciones</a>
      <a href="huespedes.php">Huéspedes</a>
      <a href="reservaciones.php">Reservaciones</a>
    </div>
  </div>

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
  
  <section class="card slider-container">
    <div class="slider">
      <img src="img/1.jpg" class="slide active" alt="Hotel 1">
      <img src="img/2.jpg" class="slide" alt="Hotel 2">
      <img src="img/3.jpg" class="slide" alt="Hotel 3">
    </div>
    <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
    <button class="next" onclick="changeSlide(1)">&#10095;</button>
  </section>

  <section class="card">
    <h2>Bienvenidos a Zona Hotelera: Tu Descanso Ideal</h2>
    <button id="toggleBtn" class="btn-accion">¿Por qué elegirnos?</button>
    
    <div id="infoAdicional" style="display: none; margin-top: 15px;">
      <ul style="text-align: left; line-height: 1.6;">
     <li><strong>Comodidad Garantizada:</strong> Habitaciones diseñadas para el máximo confort y descanso.</li>
        <li><strong>Seguridad Integral:</strong> Contamos con sistemas de gestión modernos para proteger tu estancia y tus datos.</li>
        <li><strong>Atención de Calidad:</strong> Un equipo comprometido con brindarte la mejor experiencia en cada momento.</li>
        <li><strong>Ubicación Privilegiada:</strong> Localizados en la Zona Hotelera Central, cerca de los mejores atractivos.</li>
    </ul>
    </div>
  </section>

</main>

<footer class="footer">
  <div class="footer-content">
    <div class="footer-section">
      <h3>Sobre Nosotros</h3>
      <p>
        Somos una zona hotelera comprometida con brindar la mejor
        experiencia a nuestros huéspedes, ofreciendo comodidad,
        seguridad y atención de calidad.
      </p>
    </div>

    <div class="footer-section">
      <h3>Contáctanos</h3>
      <p>📍 Dirección: Zona Hotelera Central</p>
      <p>📞 Teléfono: (555) 123-4567</p>
      <p>✉️ Email: contacto@zonahotelera.com</p>
    </div>
  </div>

  <p class="footer-copy">
    © 2026 Sistema Zona Hotelera. Todos los derechos reservados.
  </p>
</footer>

<script src="js/main.js"></script>
</body>
</html>
