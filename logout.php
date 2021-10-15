<?php
session_start();

file_put_contents('serveur/log.txt', "\r\nDeconnexion de l utilisateur   ".$_SESSION['user']."-".$_SESSION['user']['noms']." |  ".date('Y-m-d  h:i:sa').""  , FILE_APPEND);

session_unset();
session_destroy();

header( "refresh:2;url=login.php" );
exit;
?>