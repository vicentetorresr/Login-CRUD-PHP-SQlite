function eliminarUsuario(element) {
  var row = element.parentNode.parentNode;
  var cells = row.getElementsByTagName("td");
  
  // Verificar si hay suficientes elementos en el array cells
  if (cells.length < 1) {
    console.error("No se encontraron suficientes elementos td en la fila.");
    return;
  }

  // Obtener el valor de la celda ID
  var id = cells[0].getElementsByTagName("span")[0].textContent;
  
  // Mostrar una confirmación al usuario
  var confirmar = confirm("¿Estás seguro de que deseas eliminar este usuario?");
  
  if (confirmar) {
    // Realizar una solicitud AJAX al servidor para eliminar el usuario
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/crud/eliminarUsuario.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // La solicitud se completó con éxito
        // Redireccionar a la página PHP deseada
      }
      window.location.href = "../php/mostrarUsuarios.php";
    };
    xhr.send("id=" + id);
  }
}
