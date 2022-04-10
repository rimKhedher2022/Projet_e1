<?php


function connect()
{

    $servername ="localhost";
    $dbuser="root"; 
    $dbpassword="" ; 
    $dbname="ecommerce"; 
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
      return $conn ; 

}

function getAllCategorie ()
{
    $conn  = connect();
    
      $requete= "select * FROM categorie";
    
      $resultat=$conn->query($requete);
      $categories=$resultat->fetchAll() ; 
      //var_dump($categories);
    return $categories;
    
}

function getAllProducts ()
{

    $conn  = connect();
    
      $requete= "select * FROM produit";
    
      $resultat=$conn->query($requete);
      $produits=$resultat->fetchAll() ; 
      //var_dump($categories);
    return $produits;
}



function searchProduits($keywords)
{

    $conn  = connect();
    
    
      $requete= "select * FROM produit where nom LIKE '%$keywords%' ";
    
      $resultat=$conn->query($requete);
      $produits=$resultat->fetchAll() ; 
      //var_dump($categories);
    return $produits;

}

function getProduitById($id)
{
    $conn = connect(); 
    $requete ="SELECT * FROM produit where id=$id";
    $resultat=$conn->query($requete);
    $produit=$resultat->fetch() ;
    return $produit;
}



 function AddVisiteur($data)
{
  $conn  = connect();
  $RIM ="INSERT INTO visiteur(email,mp,nom,prenom,telephone) VALUES ('".$data['email']."','".$data['mp']."','".$data['nom']."','".$data['prenom']."','".$data['telephone']."')";
  $res= $conn->query($RIM);
 //$res->fetch() ;
 if($res)
  {
    return true ;
  }
  else 
  {
    return false ; 
  }

  
}


function ConnectVisiteur($data)
{
  $conn = connect();
  $email=$data['email'];
  $mp=$data['mp'];
  $req1="SELECT * FROM visiteur WHERE email='$email' AND mp='$mp'"; 
  $res = $conn->query($req1) ;
  $user = $res->fetch();
  return $user;


}
?>