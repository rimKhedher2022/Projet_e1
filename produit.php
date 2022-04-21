<?php
session_start();
include "inc/functions.php";

$categories = getAllCategorie();

if(isset($_GET['id']))
{
   $produit = getProduitById($_GET['id']);

}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <!-- navbar-->
    <?php
    include "inc/header.php";
    ?>



    <!--fin navbar-->


    <div class="row col-12 mt-4">

    <?php if($_SESSION['etat']==0){ // user non validé
           
           print' <div class="alert alert-danger">
           Compte non validé

                    </div>
                    ';

    } ?>


        <div class="card col-8 offset-2">
            <img src="images/<?php echo $produit['image']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $produit['nom'] ?></h5>
                <p class="card-text"><?php echo $produit['description'] ?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $produit['prix'] ?> DT</li>

                <?php 
                 foreach ($categories as $index => $c)

                {
                    if($c['id']==$produit['categorie'])

                    {
                       print '<button class="list-group-item">'.$c['nom'].'</button>';

                    }
                }
                ?>
               
                

            </ul>

            <div >
            <form  class="d-flex" action="actions/commander.php" method="POST">
                <input type="hidden" name="produit" value="<?php echo $produit['id'] ?>" >
                <input type="number" class="form-control" name="quantite" step="1" placeholder="quantité de produit">
            <button type="submit" <?php if($_SESSION['etat']==0){echo "disabled";} ?> class="btn btn-primary">commander</button>
            </form>
        </div>
        </div>


    </div>


    <?php include "inc/footer.php"?>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>