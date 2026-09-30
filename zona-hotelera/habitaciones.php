<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Habitaciones</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<header class="header">
  <h1>Sistema Zona Hotelera</h1>
  <p>Gestión de habitaciones, huéspedes y reservaciones</p>
</header>

<nav class="nav">
  <a href="index.php">Inicio</a>
  <a href="habitaciones.php" class="active">Habitaciones</a>
  <a href="huespedes.php">Huéspedes</a>
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
    <h2>Registro de Habitaciones</h2>

    <form id="formHabitacion" enctype="multipart/form-data">
      <input type="text" name="numero" id="numero" placeholder="Número de habitación" required>
      <input type="text" name="tipo" id="tipo" placeholder="Tipo de habitación (Ej: Suite, Doble)" required>
      <input type="number" name="precio" id="precio" placeholder="Precio por noche" required>
      
      <label style="display:block; margin-bottom:10px; font-weight:600;">Foto de la habitación:</label>
      <input type="file" name="foto" id="foto" accept="image/*" required>

      <button type="submit">Guardar Habitación</button>
    </form>
  </div>
</main>

<section class="card" style="margin-top: 30px;">
    <h2>Listado de Habitaciones</h2>
    <table class="tabla-hab">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Número</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Acciones</th> </tr>
        </thead>
        <tbody>
            <?php
            include "../bd/conexion.php"; 
            $query = "SELECT * FROM habitaciones ORDER BY id DESC";
            $resultado = $conn->query($query);

            if ($resultado->num_rows > 0):
                while($fila = $resultado->fetch_assoc()):
            ?>
                <tr>
                    <td>
                        <img src="<?php echo $fila['foto_url']; ?>" alt="Habitación" class="img-habitacion">
                    </td>
                    <td><?php echo $fila['numero']; ?></td>
                    <td><?php echo $fila['tipo']; ?></td>
                    <td>$<?php echo number_format($fila['precio'], 2); ?></td>
                    <td>
                        <button type="button" 
                                onclick="eliminarHabitacion(<?php echo $fila['id']; ?>)" 
                                style="background:#ef4444; width:auto; padding:8px 12px; font-size:13px;">
                            Eliminar
                        </button>
                    </td>
                </tr>
            <?php 
                endwhile;
            else: 
            ?>
                <tr>
                    <td colspan="5" style="text-align:center;">No hay habitaciones registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<script src="js/habitaciones.js"></script>

</body>
</html>
