<?php

$idvisiteur = $_GET['id'];
include "../../inc/functions.php"; 
$conn=connect();

$req="UPDATE visiteur SET etat=1 WHERE id ='$idvisiteur'";

$result = $conn->query($req); 

if ($result)
{
header('location:liste.php?valider=ok');
}
else{
    echo "erreur de validation";
}



?>