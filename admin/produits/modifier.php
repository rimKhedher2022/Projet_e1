<?php
session_start();

$id = $_POST['idc'];
$nom = $_POST['nom'];
$description = $_POST['description'];

$date_modification = date("Y-m-d");
include "../../inc/functions.php"; 
$conn=connect();

$requete ="UPDATE produit SET nom='$nom',description='$description', 
date_modification='$date_modification' WHERE id='$id'";
$resultat=$conn->query($requete);


if($resultat)

{
   header('location:liste.php?modif=ok');
}

?>