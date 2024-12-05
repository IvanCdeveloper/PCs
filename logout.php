<?php
// Iniciar la sesión
session_start();

// Destruir la sesión
session_destroy();

// Redirigir al usuario al formulario de login o a index.html
header("Location: index.html");
exit;