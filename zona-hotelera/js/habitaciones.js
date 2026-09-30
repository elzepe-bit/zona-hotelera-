document.getElementById("formHabitacion").addEventListener("submit", e => {
    e.preventDefault();

    // FormData empaqueta automáticamente textos y archivos
    const datos = new FormData(e.target);
    datos.append("accion", "guardar_habitacion");

   fetch("../backend/habitaciones_controlador.php", {
    method: "POST",
    body: datos
})
    .then(res => res.text())
    .then(respuesta => {
        if (respuesta.trim() === "ok") {
            alert("Habitación guardada con éxito");
            location.reload(); // Para limpiar el formulario
        } else {
            alert("Error al guardar: " + respuesta);
        }
    })
    .catch(error => console.error("Error:", error));
});

// NUEVA FUNCIÓN: Eliminar
function eliminarHabitacion(id) {
    if (confirm("¿Seguro que quieres eliminar esta habitación y su imagen?")) {
        const datos = new FormData();
        datos.append("id", id);
        datos.append("accion", "eliminar_habitacion");

        fetch("../backend/habitaciones_controlador.php", {
            method: "POST",
            body: datos
        })
        .then(res => res.text())
        .then(respuesta => {
            if (respuesta.trim() === "ok") {
                location.reload();
            } else {
                alert("Error al eliminar: " + respuesta);
            }
        });
    }
}