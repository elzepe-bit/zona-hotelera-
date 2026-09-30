document.getElementById("formRestablecer").addEventListener("submit", e => {
    e.preventDefault();

    const p1 = document.getElementById("pass1").value;
    const p2 = document.getElementById("pass2").value;
    const token = document.getElementById("tokenReset").value;

    // 1. Validamos que el usuario no se haya equivocado al repetir la contraseña
    if (p1 !== p2) {
        alert("Las contraseñas no coinciden. Por favor, revisa.");
        return; // Detiene la ejecución si no son iguales
    }

    // 2. Preparamos los datos para enviarlos al backend
    const datos = new FormData();
    datos.append("accion", "guardar_nueva_pass");
    datos.append("token", token);
    datos.append("password", p1);

    // Efecto visual de carga en el botón
    const boton = document.querySelector("#formRestablecer button[type='submit']");
    const textoOriginal = boton.innerText;
    boton.innerText = "Guardando...";
    boton.disabled = true;

    // 3. Enviamos la petición a tu archivo auth.php
    fetch("../backend/auth.php", {
        method: "POST",
        body: datos
    })
    .then(res => res.text())
    .then(respuesta => {
        boton.innerText = textoOriginal;
        boton.disabled = false;

        if (respuesta.trim() === "ok") {
            alert("¡Contraseña actualizada con éxito! Ya puedes iniciar sesión con tu nueva clave.");
            window.location.href = "login.php"; // Lo mandamos al inicio de sesión
        } else {
            alert("Ocurrió un error al intentar guardar tu contraseña.");
        }
    })
    .catch(error => {
        boton.innerText = textoOriginal;
        boton.disabled = false;
        alert("Error de red. Revisa tu conexión a internet.");
    });
});