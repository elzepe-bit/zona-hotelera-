const tabla = document.getElementById("tablaHuespedes");
const form = document.getElementById("formHuesped");

const idInput = document.getElementById("id");
const nombre = document.getElementById("nombre");
const correo = document.getElementById("correo");
const telefono = document.getElementById("telefono");
const btn = form.querySelector("button");

cargarHuespedes();

/* ======================
   LISTAR
====================== */
function cargarHuespedes() {
  fetch("../backend/huespedes.php?accion=listar")
    .then(res => res.json())
    .then(data => {
      tabla.innerHTML = "";

      data.forEach(h => {
        tabla.innerHTML += `
          <tr>
            <td>${h.id}</td>
            <td>${h.nombre}</td>
            <td>${h.correo}</td>
            <td>${h.telefono}</td>
           <td class="acciones">
  <button class="btn btn-editar" onclick="editar(${h.id})">✏️</button>
  <button class="btn btn-eliminar" onclick="eliminar(${h.id})">🗑️</button>
        </td>

          </tr>
        `;
      });
    })
    .catch(err => console.error("Error al listar:", err));
}

/* ======================
   GUARDAR / EDITAR
====================== */
form.addEventListener("submit", e => {
  e.preventDefault();

  const datos = new FormData();

  if (btn.dataset.editando === "true") {
    datos.append("accion", "editar");
    datos.append("id", idInput.value);
  } else {
    datos.append("accion", "guardar");
  }

  datos.append("nombre", nombre.value);
  datos.append("correo", correo.value);
  datos.append("telefono", telefono.value);

  fetch("../backend/huespedes.php", {
    method: "POST",
    body: datos
  })
    .then(() => {
      form.reset();
      btn.textContent = "Guardar";
      delete btn.dataset.editando;
      cargarHuespedes();
    });
});

/* ======================
   EDITAR
====================== */
function editar(id) {
  fetch(`../backend/huespedes.php?accion=obtener&id=${id}`)
    .then(res => res.json())
    .then(h => {
      idInput.value = h.id;
      nombre.value = h.nombre;
      correo.value = h.correo;
      telefono.value = h.telefono;

      btn.textContent = "Actualizar";
      btn.dataset.editando = "true";
    })
    .catch(err => console.error("Error al obtener:", err));
}

/* ======================
   ELIMINAR
====================== */
function eliminar(id) {
  if (!confirm("¿Eliminar huésped?")) return;

  const datos = new FormData();
  datos.append("accion", "eliminar");
  datos.append("id", id);

  fetch("../backend/huespedes.php", {
    method: "POST",
    body: datos
  }).then(() => cargarHuespedes());
}

/* ======================
   BUSCADOR
====================== */
const buscador = document.getElementById("buscador");

buscador.addEventListener("keyup", () => {
  const texto = buscador.value.toLowerCase();
  const filas = document.querySelectorAll("#tablaHuespedes tr");

  filas.forEach(fila => {
    fila.style.display = fila.textContent.toLowerCase().includes(texto)
      ? ""
      : "none";
  });
});
