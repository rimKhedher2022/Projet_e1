<?php
//echo "id de categorie".$_GET['idc'];


$idproduit = $_GET['idc'];

include "../../inc/functions.php";
$conn = connect();
$req ="DELETE FROM produit WHERE id = '$idproduit'";
$res = $conn->query($req);


if($res)
{
   // echo "cat sup";
   header('location:liste.php?delete=ok');
}


?>