<?php
session_start();

$nom = $_POST['nom'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$createur = $_POST['createur'];
$categorie = $_POST['categorie'];
$quantite = $_POST['quantite'];
$date_creation = date("Y-m-d");





$target_dir = "../../images/";
$target_file = $target_dir.basename($_FILES["image"]["name"]);

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $image = $_FILES["image"]["name"];
  } else {
    echo "Sorry, there was an error uploading your file.";
  }

  $date = date('Y-m-d'); 


  
include "../../inc/functions.php"; 
$conn=connect();



try {
    $requete ="INSERT INTO produit(nom,description,prix,image,createur,categorie,date_creation) VALUES ('$nom','$description','$prix','$image','$createur','$categorie','$date')";
    

    $resultat=$conn->query($requete);

   
    if($resultat)

    {

      $produit_id = $conn->lastInsertId();


      $requete2 ="INSERT INTO stock(produit,quantité,createur,date_creation) VALUES ('$produit_id','$quantite','$createur','$date_creation')";
      if($conn->query($requete2))
      {
        header('location:liste.php?ajout=ok');
      }else{
        echo "impossible d'ajouter le stock du produit";
      }


     
    }

    } catch(PDOException $e) {
      
      if ($e->getCode()==23000) 
      {
        header('location:liste.php?erreur=duplicate');
      }
    }

?>