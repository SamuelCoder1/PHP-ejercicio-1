<?php
session_start();
//Se cierra la sesion y redirijo al usuario al login
session_destroy(); 
header('Location: index.php'); 
exit;
?>
