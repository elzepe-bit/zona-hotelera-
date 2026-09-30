// --- Lógica Mostrar/Ocultar ---
const toggleBtn = document.getElementById('toggleBtn');
const infoAdicional = document.getElementById('infoAdicional');

toggleBtn.addEventListener('click', () => {
    if (infoAdicional.style.display === 'none') {
        infoAdicional.style.display = 'block';
        toggleBtn.innerText = 'Ocultar información';
    } else {
        infoAdicional.style.display = 'none';
        toggleBtn.innerText = '¿Por qué elegirnos?';
    }
});

// --- Lógica Carrusel (Slider) ---
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');

function changeSlide(n) {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + n + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
}

// Cambio automático cada 5 segundos
setInterval(() => changeSlide(1), 5000);