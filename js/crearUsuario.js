function addUser() {
  var table = document.getElementById("tablaUsuarios");
  var newRow = table.insertRow(-1);

  var idCell = newRow.insertCell(0);
  idCell.innerHTML = "<span class='' contenteditable='false'></span>";

  var usernameCell = newRow.insertCell(1);
  usernameCell.innerHTML = "<span class='editable' contenteditable='true' style='cursor: text;'></span>";

  var passwordCell = newRow.insertCell(2);
  passwordCell.innerHTML = "<span class='editable' contenteditable='true' style='cursor: text;'></span>";

  var roleCell = newRow.insertCell(3);
  roleCell.innerHTML = "<span class='editable' contenteditable='true' style='cursor: text;'></span>";

  var actionCell = newRow.insertCell(4);
  actionCell.innerHTML = "<span class='guardar' onclick='saveNewUser(this)'><i class='fas fa-save'></i></span>" +
                         "<span class='cancelar' onclick='cancelNewUser(this)'><i class='fas fa-times'></i></span>";
}


function saveNewUser(element) {
  var newRow = element.parentNode.parentNode;
  var cells = newRow.getElementsByTagName("td");
  var username = cells[1].querySelector(".editable").textContent;
  var password = cells[2].querySelector(".editable").textContent;
  var role = cells[3].querySelector(".editable").textContent;
  
  console.log(username, password, role);
  
  if (role !== "1" && role !== "0") {
    alert("El valor de role debe ser 1 o 0.");
    return; // No se realizan cambios ni se envía la solicitud al servidor
  } else {
    // Realizar una solicitud al servidor para guardar los cambios en la base de datos
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/crud/newUser.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Manejar la respuesta del servidor si es necesario
        console.log(xhr.responseText);
        
        // Redirigir a la página después de recibir la respuesta del servidor
        window.location.href = "../php/mostrarUsuarios.php";
      }
    };
    xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password) + "&role=" + encodeURIComponent(role));
  }
}

  function cancelNewUser(element) {
    var newRow = element.parentNode.parentNode;
    newRow.remove();
  }