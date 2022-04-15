<?php
//echo "id de categorie".$_GET['idc'];


$idcategorie = $_GET['idc'];

include "../../inc/functions.php";
$conn = connect();
$req ="DELETE FROM categorie WHERE id = '$idcategorie'";
$res = $conn->query($req);


if($res)
{
   // echo "cat sup";
   header('location:liste.php?delete=ok');
}


?>