document.getElementById("formularioContacto").addEventListener("submit", function(e) {
    const nombre = document.getElementById("nombre").value.trim();
    const apellido = document.getElementById("apellido").value.trim();
    const mail = document.getElementById("mail").value.trim();
    const mensaje = document.getElementById("mensaje").value.trim();
    const emailErr = document.getElementById("email-error");

    emailErr.textContent = "";

    let isValid = true;

    if (!nombre || !apellido || !mail || !mensaje) {
        alert("Completá todos los campos");
        isValid = false;
    }

    if (mail === "" || !mail.includes("@") || !mail.includes(".")) {
        emailErr.textContent = "Ingresá un email válido";
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
    }
});