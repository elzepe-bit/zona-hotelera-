document.getElementById("formRegistro").addEventListener("submit", e => {
  e.preventDefault();

  const datos = new FormData();
  datos.append("accion", "registro");
  datos.append("nombre", nombre.value);
  datos.append("ap", ap.value);
  datos.append("am", am.value);
  datos.append("usuario", usuarioR.value);
  datos.append("correo", correo.value);
  datos.append("direccion", direccion.value);
  datos.append("telefono", telefono.value);
  datos.append("password", passwordR.value);

  fetch("../backend/auth.php", {
    method: "POST",
    body: datos
  })
  .then(r => r.text())
  .then(res => {
    if (res === "ok") {
      alert("Registro exitoso");
      location.href = "login.php";
    } else {
      alert("Error al registrar");
    }
  });
});
