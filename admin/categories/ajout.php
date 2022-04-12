<?php
session_start();


$nom = $_POST['nom'];
$description = $_POST['description'];
$createur = $_SESSION['id'];
$date_creation = date("Y-m-d");
include "../../inc/functions.php"; 
$conn=connect();

$requete ="INSERT INTO categorie(nom,description,createur,date_creation) VALUES ('$nom','$description','$createur','$date_createur')";
$resultat=$conn->query($requete);


if($resultat)

{
   header('location:liste.php?ajout=ok');
}

?>