<?php 

session_start();

include "../inc/functions.php";
$conn = connect();

$visiteur=$_SESSION['id'];
$total=$_SESSION['panier'][1];
$date=date('Y-m-d');


$req_panier="INSERT INTO panier (visiteur, total ,date_creation) VALUES('$visiteur','$total','$date') ";
$res1 = $conn->query($req_panier);

$panier_id=$conn->lastInsertId();
$commandes=$_SESSION['panier'][3];


foreach($commandes as $commande)
{
    $quantite=$commande[0];
    $total=$commande[1];
    $id_produit=$commande[4];

    $requette2 ="INSERT INTO commande (quantite,total,panier,date_creation,date_modification,produit) VALUES ('$quantite','$total','$panier_id','$date','$date','$id_produit') ";
    $res1 = $conn->query($requette2);

}




$_SESSION['panier']=null; 
header('location:../index.php');




// ajouter commande 
// requete 



?>