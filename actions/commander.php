<?php 

session_start();

 if (!isset($_SESSION['nom']))
 {

   header('location:../connexion.php');
    exit();
   
 }

// // creation de panier

// // 
include "../inc/functions.php";
$conn = connect();
 $visiteur =$_SESSION['id'];









// //var_dump($_POST);
 $id_produit= $_POST['produit'];
 $quantite= $_POST['quantite'];
// // selectionner le produit avec son id 

// // 


 $requette ="SELECT prix , nom FROM produit WHERE id='$id_produit' ";
 $res = $conn->query($requette);
 $produit = $res->fetch();
 $total= $quantite * $produit['prix'];
$date = date ("Y-m-d");

if(!isset($_SESSION['panier'])) //panier n'existe pas
{$_SESSION['panier']=array($visiteur,0,$date,array());}// creation du panier


$_SESSION['panier'][1]+=$total;


$_SESSION['panier'][3][]=array($quantite,$total,$date,$date,$id_produit,$produit['nom']);









// $req_panier="INSERT INTO panier (visiteur, total ,date_creation) VALUES('$visiteur','$total','$date') ";
// $res1 = $conn->query($req_panier);

// $panier_id=$conn->lastInsertId();





// // ajouter commande 
// // requete 

// $requette2 ="INSERT INTO commande (quantite,total,panier,date_creation,date_modification,produit) VALUES ('$quantite','$total','$panier_id','$date','$date','$id_produit') ";
// $res1 = $conn->query($requette2);

header('location:../panier.php');



?>