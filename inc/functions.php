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
  $mphash = md5($data['mp']);
  $RIM ="INSERT INTO visiteur(email,mp,nom,prenom,telephone) VALUES ('".$data['email']."','".$mphash."','".$data['nom']."','".$data['prenom']."','".$data['telephone']."')";
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
  $mp = md5($data['mp']);
  $mp=$data['mp'];
  $req1="SELECT * FROM visiteur WHERE email='$email' AND mp='$mp'"; 
  $res = $conn->query($req1) ;
  $user = $res->fetch();
  return $user;


}

function ConnectAdmin($data)
{

  $conn = connect();
  $email=$data['email'];
  $mp = md5($data['mp']);
  $mp=$data['mp'];
  $req1="SELECT * FROM administrateur WHERE email='$email' AND mp='$mp'"; 
  $res = $conn->query($req1) ;
  $user = $res->fetch();
  return $user;
}

function getAllusers()

{
  $conn = connect();

  $req1="SELECT * FROM visiteur WHERE etat=0"; 
  $res = $conn->query($req1) ;
  $users = $res->fetchAll();

  return $users;

}


function getStocks()
{
  $conn = connect();

  $req1="SELECT nom, quantite from produit,stock where ptoduit.id=stock.produit"; 
  $res = $conn->query($req1) ;
  $stocks = $res->fetchAll();

  return $stocks;

}
?>