
document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    if (toggleButton) {
        toggleButton.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }
});


function validarApenasLetras(input) {
    const regex = /^[A-Za-zÀ-ÿ\s]+$/;
    if (!regex.test(input.value) && input.value !== "") {
        alert("Este campo aceita apenas letras!");
        input.value = input.value.replace(/[0-9]/g, '');
    }
}

function validarApenasNumeros(input) {
    const regex = /^[0-9]+$/;
    if (!regex.test(input.value) && input.value !== "") {
        alert("Este campo aceita apenas números!");
        input.value = input.value.replace(/[^0-9]/g, '');
    }
}


function avaliarForcaSenha(senha) {
    let forca = 0;
    if (senha.length >= 6) forca++;
    if (/[A-Z]/.test(senha)) forca++;
    if (/[0-9]/.test(senha)) forca++;
    
    const feedback = document.getElementById('feedback-senha');
    if (!feedback) return;

    if (senha.length === 0) {
        feedback.textContent = "";
    } else if (forca <= 1) {
        feedback.textContent = "Senha Fraca 🔴";
        feedback.style.color = "red";
    } else if (forca === 2) {
        feedback.textContent = "Senha Média 🟡";
        feedback.style.color = "orange";
    } else {
        feedback.textContent = "Senha Forte 🟢";
        feedback.style.color = "green";
    }
}
