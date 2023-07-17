function saveChanges(element) {
  var row = element.parentNode.parentNode;
  var cells = row.getElementsByClassName("editable");

  // Verificar si hay suficientes elementos en el array cells
  if (cells.length < 4) {
    console.error("No se encontraron suficientes elementos con la clase 'editable'.");
    return;
  }

  // Obtener los valores modificados de las celdas
  var id = cells[0].textContent;
  var username = cells[1].textContent;
  var password = cells[2].textContent;
  var role = cells[3].textContent;

  // Verificar si el valor de role es 1 o 0
  if (role !== "1" && role !== "0") {
    alert("El valor de role debe ser 1 o 0.");
    window.location.href = "../php/mostrarUsuarios.php";
    return; // No se realizan cambios ni se envía la solicitud al servidor
  } else if (username === "" || password === "" || role === "") {
    alert("Rellene todos los datos.");
    window.location.href = "../php/mostrarUsuarios.php";
    return; // No se realizan cambios ni se envía la solicitud al servidor
    }
  else{
    // Realizar una solicitud al servidor para guardar los cambios en la base de datos
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/crud/guardar_cambios.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Manejar la respuesta del servidor si es necesario
        console.log(xhr.responseText);
      }
      window.location.href = "../php/mostrarUsuarios.php";
    };
    xhr.send("id=" + id + "&username=" + username + "&password=" + password + "&role=" + role);
    // Restaurar el estado de edición a falso (contenteditable=false)
    for (var i = 0; i < cells.length; i++) {
      cells[i].setAttribute("contenteditable", "false");
      window.location.href = "../php/mostrarUsuarios.php";
  }
}
}
function makeEditable(element) {
  var row = element.parentNode.parentNode;
  var cells = row.getElementsByClassName("editable");

  for (var i = 1; i < cells.length; i++) {
    var isEditable = cells[i].getAttribute("contenteditable") === "true";
    if (isEditable) {
      cells[i].setAttribute("contenteditable", "false");
      cells[i].textContent = "";
    } else {
      cells[i].setAttribute("contenteditable", "true");
      cells[i].setAttribute("data-original-value", cells[i].textContent);

      // Limpiar el campo al hacer clic en él
      cells[i].addEventListener("click", function() {
        this.textContent = "";
      });
    }
  }
}

