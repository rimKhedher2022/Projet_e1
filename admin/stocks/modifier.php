<?php
session_start();

$id = $_POST['idstock'];
$quantite = $_POST['quantite'];



include "../../inc/functions.php"; 
$conn=connect();

$requete ="UPDATE stock SET quantite='$quantite'WHERE id='$id'";
$resultat=$conn->query($requete);


if($resultat)

{
   header('location:liste.php?modif=ok');
}

?>