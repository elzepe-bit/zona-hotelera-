document.getElementById("formLogin").addEventListener("submit", e => {
  e.preventDefault();

  const datos = new FormData();
  datos.append("accion", "login");
  
  // Es más seguro capturar el valor directamente con el ID del elemento
  const usuarioInput = document.getElementById("usuario").value;
  const passwordInput = document.getElementById("password").value;
  
  datos.append("usuario", usuarioInput);
  datos.append("password", passwordInput);

  fetch("../backend/auth.php", {
    method: "POST",
    body: datos
  })
  .then(res => res.text())
  .then(respuesta => {
    // Limpiamos la respuesta de cualquier espacio en blanco accidental con .trim()
    const rol = respuesta.trim();

    // Evaluamos qué rol devolvió la base de datos
    if (rol === "admin") {
      // Si es admin, puedes mandarlo a un panel especial o al index
      window.location.href = "index.php"; 
    } else if (rol === "recepcionista" || rol === "usuario") {
      // Si es recepcionista o usuario normal, va a la vista estándar
      window.location.href = "index.php"; 
    } else if (rol === "error") {
      // Si las credenciales no coinciden en la base de datos
      alert("Usuario o contraseña incorrectos");
    } else {
      // Por si hay algún error de conexión o del servidor
      alert("Ocurrió un error inesperado. Inténtalo de nuevo.");
    }
  });
});