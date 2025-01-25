// Cargar usuarios desde el archivo JSON
const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];

// Función para autenticar al usuario
function autenticar(email, password) {
  const usuario = usuarios.find((usuario) => usuario.email === email && usuario.password === password);
  if (usuario) {
    return usuario;
  } else {
    return null;
  }
}

// Función para redirigir al usuario según su rol
function redirigir(usuario) {
  if (usuario.rol === 'administrador') {
    window.location.href = 'admin.html';
  } else if (usuario.rol === 'cliente') {
    window.location.href = 'perfil.html';
  } else if (usuario.rol === 'invitado') {
    window.location.href = 'perfil.html';
  }
}

// Evento para el botón de login
document.getElementById('login-button').addEventListener('click', (e) => {
  e.preventDefault();
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const usuario = autenticar(email, password);
  if (usuario) {
    redirigir(usuario);
  } else {
    alert('Credenciales incorrectas');
  }
});
