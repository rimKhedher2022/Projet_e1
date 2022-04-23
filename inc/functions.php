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

  $req1="SELECT s.id,p.nom , s.quantite FROM produit p,stock s WHERE p.id=s.produit"; 
  $res1 = $conn->query($req1) ;
  $stocks = $res1->fetchAll();

  return $stocks;

}



function  getAllPaniers()
{
  $conn = connect();

  $req1="SELECT v.nom , v.prenom,v.telephone,p.total , p.etat , p.date_creation , p.id FROM panier p,visiteur v WHERE p.visiteur = v.id"; 
  $res1 = $conn->query($req1) ;
  $paniers = $res1->fetchAll();

  return $paniers;

}



function getAllCommandes()

{

  $conn = connect();

  $req1="SELECT p.nom, p.image , c.quantite , c.total , c.panier FROM commande c , produit p WHERE c.produit=p.id"; 
  $res1 = $conn->query($req1) ;
  $commandes = $res1->fetchAll();

  return $commandes;

}




function changerEtatPanier($data)

{

  $conn = connect();

  $req1="UPDATE panier SET etat='".$data['etat']."' WHERE id='".$data['panier_id']."'";
  $res1 = $conn->query($req1) ;
  
  

}

function getPaniersByEtat($paniers,$etat)

{
  $paniersEtat =array();

  foreach($paniers as $p)
  {
    if($p['etat'] == $etat)
    {
      array_push($paniersEtat,$p);
    }
  }
  return $paniersEtat;

}



function EditAdmin($data)

{

  $conn = connect();

  if($data['mp']!="")
  {
    $req1="UPDATE administrateur SET nom='".$data['nom']."',email='".$data['email']."' ,mp ='".md5($data['mp'])."' WHERE id='".$data['id_admin']."'";

  }
  else
  {
    $req1="UPDATE administrateur SET nom='".$data['nom']."',email='".$data['email']."'  WHERE id='".$data['id_admin']."'";

  }
  
  $res1 = $conn->query($req1) ;
  return true;


}
?>