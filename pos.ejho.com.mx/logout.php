<?php
session_start();
unset($_SESSION["userid"]);

unset($_SESSION["nombre"]);
header("Location:index.php");
?>