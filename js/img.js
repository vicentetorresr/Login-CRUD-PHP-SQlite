function mostrarImagen(id) {
  var dialog = document.getElementById(id);
  dialog.style.display = 'block';
}

function ocultarImagen(id) {
  var dialog = document.getElementById(id);
  dialog.style.display = 'none';
}

document.querySelector('.menu-toggle-label').addEventListener('click', function () {
    var nav = document.querySelector('nav');
    var overlay = document.querySelector('.overlay');
    
    if (nav.style.display === 'block') {
        nav.style.display = 'none';
        overlay.style.display = 'none';
    } else {
        nav.style.display = 'block';
        overlay.style.display = 'block';
    }
});

document.querySelector('.overlay').addEventListener('click', function () {
    var nav = document.querySelector('nav');
    var overlay = document.querySelector('.overlay');
    
    nav.style.display = 'none';
    overlay.style.display = 'none';
});

function logout() {
  window.location.href = "inicio.php?logout=true";
}