<?php
session_start();
include "../../inc/functions.php";
if(isset($_POST['btnSubmit']))
{
//changer etat de panier

changerEtatPanier($_POST);

}



$paniers = getAllPaniers();
$commandes = getAllCommandes();

if(isset($_POST['btnSearch']))

{



            if($_POST['etat']=="all")
            {
                $paniers = getAllPaniers();  
            }
            else
            {
                $paniers = getPaniersByEtat($paniers,$_POST['etat']);
            }
 

}



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Admin profile</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">



    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="../../css/dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="../../deconnexion.php">deconnexion</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <?php include "../template/navigation.php" ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Liste des paniers</h1>






                


                </div>
                <!--liste debut-->

                <div>





                <form action="<?php echo $_SERVER['PHP_SELF'] ;?> " method="POST">
                    <div class="form-group d-flex">
                        <select name="etat" class="form-control">
                            <option value="">-- choisir l'etat -- </option>
                            <option value="all">all</option>
                            <option value="en cours">en cours </option>
                            <option value="livraison termine">Livraison termine</option>
                            
                        
                        </select>
                          <input  type="submit" value="chercher" name="btnSearch" class="btn btn-primary"/> 

                    
                    </div>
               
                </form>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Client</th>
                                <th scope="col">Total</th>
                                <th scope="col">Date</th>
                                <th scope="col">Etat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $i=0;
                            foreach ($paniers as $p) {
                                $i++;
                                print '
                                <tr>
                                <th scope="row">' .$i. '</th>
                                <td>' . $p['nom'].' '.$p['prenom']. '</td>
                                <td>' . $p['total'] . '</td>
                                <td>' . $p['date_creation'] . '</td>
                                <td>' . $p['etat'] . '</td>
                                <td>
                                    
                                    <a  data-bs-toggle="modal" data-bs-target="#Commandes' . $p['id'] . '" class="btn btn-success">afficher</a>
                                      <a data-bs-toggle="modal" data-bs-target="#Traiter'.$p['id'].'"  class="btn btn-primary">Traiter</a>


                                </td>
                              </tr>
                                ';
                            }

                            ?>



                        </tbody>
                    </table>




                </div>


            </main>
        </div>
    </div>



    <?php
    foreach ($paniers as $index => $p) { ?>

        <!-- Modal Modification -->

        <div class="modal fade" id="Commandes<?php echo $p['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Liste des commandes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <table class="table">

                        <thread>
                            <tr>
                                <th>Nom produit</th>
                                <th>Image</th>
                                <th>Quantite</th>
                                <th>total</th>
                               
                            </tr>
                        </thread>
                        <tbody>

                        <?php
                        foreach($commandes as $index =>$c)
                        {

                            if($c['panier'] == $p['id'])
                            { // si commande appartient (panier ouvert)
                                print'<tr>


                                <td>'.$c['nom'].'</td>
                                <td><img src="../../images/'.$c['image'].'" width="100"/></td>
                                <td>'.$c['quantite'].'</td>
                                <td>'.$c['total'].'</td>
                               
                                
                            </tr>
                            ';
                            }
                           
                        }
                        ?>





                        </tbody>
                    </table>
                       
                   </div>

                    <div class="modal-footer">
                       
                   </div>
                </div>
             </div>

        </div>

    <?php
    }


    foreach ($paniers as $index => $p) { ?>

        <!-- Modal Modification -->

        <div class="modal fade" id="Traiter<?php echo $p['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">triter la commande</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    

                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

                    <input type="hidden" value="<?php echo $p['id']; ?>" name="panier_id">
                        <div class="form-group">
                                <select name="etat" class="form-control">
                                        <option value="en livraison">en cours</option>
                                        <option value="en livraison termine"> livraison termine</option>                      
                                </select>
                        </div>
                      
                        <div class="form-group"> 
                           <button type="submit" name="btnSubmit" class="btn btn-primary">sauvegarder</button>
                        </div>

                       
                     </form>
                    
                    
                   </div>

                    <div class="modal-footer">
                       
                   </div>
                </div>
             </div>

        </div>

    <?php
    }
    ?>

   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="../../js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        ('#addform').submit(function() {
            if ($('#nom').val() == "") {
                $('#blocknom').append('<p class="text-danger">il faut remplir le champs nom..</p>');
                return false;
            }
        })
    </script>

    <script>
        function popUpDeleteCategorie() {

            return confirm("voulez vous vraiment supprimer la categorie");

        }
    </script>
</body>

</html>