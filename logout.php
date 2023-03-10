<?php
//faccio logout e distruggo la sessione e la cookie session 
session_start();
session_destroy();
setcookie(session_name(), '', time()-3600);
header('Location: index.html');
exit();
?>

