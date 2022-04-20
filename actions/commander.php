<?php 

//var_dump($_POST);
$id_produit= $_POST['produit'];
$quantite= $_POST['quantite'];
// selectionner le produit avec son id 

// 
include "../inc/functions.php";
$conn = connect();

$requette ="SELECT prix FROM produit WHERE id='$id_produit' ";
$res = $conn->query($requette);
$prix = $res->fetch();
var_dump($prix) ;



?>