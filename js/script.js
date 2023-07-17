function validateForm(event) {
  event.preventDefault(); // Evitar el envío del formulario
}

function logout() {
  window.location.href = "inicio.php?logout=true";
}