<?php
session_start();
session_unset();
session_destroy();

header('location:index.php');

// malak en train de lire le code et coder;
?>