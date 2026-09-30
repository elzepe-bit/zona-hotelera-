<?php
$conn = new mysqli("localhost", "root", "", "zona_hotelera");

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
?>
