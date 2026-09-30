<?php
include "../bd/conexion.php";

/* =====================
   GUARDAR
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'guardar') {
  $nombre = $conn->real_escape_string($_POST['nombre']);
  $correo = $conn->real_escape_string($_POST['correo']);
  $telefono = $conn->real_escape_string($_POST['telefono']);

  $conn->query("INSERT INTO huespedes (nombre, correo, telefono)
                VALUES ('$nombre','$correo','$telefono')");
  echo "ok";
  exit;
}

/* =====================
   LISTAR
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['accion'] === 'listar') {
  $res = $conn->query("SELECT * FROM huespedes ORDER BY id DESC");
  $data = [];

  while ($row = $res->fetch_assoc()) {
    $data[] = $row;
  }

  echo json_encode($data);
  exit;
}

/* =====================
   OBTENER (PARA EDITAR)
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['accion'] === 'obtener') {
  $id = (int) $_GET['id'];
  $res = $conn->query("SELECT * FROM huespedes WHERE id=$id");

  echo json_encode($res->fetch_assoc());
  exit;
}

/* =====================
   ELIMINAR
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'eliminar') {
  $id = (int) $_POST['id'];
  $conn->query("DELETE FROM huespedes WHERE id=$id");
  echo "ok";
  exit;
}

/* =====================
   EDITAR
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'editar') {
  $id = (int) $_POST['id'];
  $nombre = $conn->real_escape_string($_POST['nombre']);
  $correo = $conn->real_escape_string($_POST['correo']);
  $telefono = $conn->real_escape_string($_POST['telefono']);

  $conn->query("UPDATE huespedes
                SET nombre='$nombre', correo='$correo', telefono='$telefono'
                WHERE id=$id");
  echo "ok";
  exit;
}
