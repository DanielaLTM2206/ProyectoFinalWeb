document.getElementById("usuariosLink").addEventListener("click", function(event) {
    event.preventDefault();
    mostrarFormularioUsuarios();
});

function mostrarFormularioUsuarios() {
    var formContainer = document.getElementById('usuarioFormContainer');
    if (formContainer.style.display === 'none' || formContainer.style.display === '') {
        formContainer.style.display = 'block';
    } else {
        formContainer.style.display = 'none';
    }
}
