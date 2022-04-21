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











header('location:../panier.php');



?>