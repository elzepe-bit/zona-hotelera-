document.getElementById("formRecuperar").addEventListener("submit", e => {
  e.preventDefault();

  const datos = new FormData();
  // 🔥 Le decimos al PHP que queremos ejecutar el bloque de enviar correo
  datos.append("accion", "solicitar_correo"); 
  
  // 🔥 Capturamos el correo que escribió el usuario
  datos.append("correo", document.getElementById("correoRecuperar").value);

  // --- EFECTO VISUAL DE CARGA ---
  const boton = document.querySelector("#formRecuperar button[type='submit']");
  const textoOriginal = boton.innerText;
  boton.innerText = "Enviando correo...";
  boton.disabled = true; // Bloqueamos el botón

  fetch("../backend/auth.php", {
    method: "POST",
    body: datos
  })
  .then(res => res.text())
  .then(respuesta => {
    // --- QUITAMOS EL EFECTO DE CARGA ---
    boton.innerText = textoOriginal;
    boton.disabled = false;
    
    const resLimpia = respuesta.trim();

    // Evaluamos lo que respondió tu nuevo auth.php
    if (resLimpia === "ok") {
      alert("¡Enlace enviado! Revisa tu bandeja de entrada (y la carpeta de SPAM).");
      window.location.href = "login.php"; 
    } else if (resLimpia === "error_no_existe") {
      alert("Error: Ese correo no está registrado en nuestro sistema.");
    } else if (resLimpia.startsWith("error_correo")) {
      alert("Problema con el servidor de correos: \n" + resLimpia);
   } else {
      // Ahora el sistema nos escupirá el error real de PHP
      alert("Error del servidor:\n" + resLimpia); 
    }
  })
  .catch(error => {
    boton.innerText = textoOriginal;
    boton.disabled = false;
    alert("Error de red. Revisa tu conexión a internet.");
  });
});