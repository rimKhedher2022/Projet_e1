<?php
session_start();

include "../../inc/functions.php";
$stocks = getStocks();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Admin stocks</title>

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
                    <h1 class="h2">stocks des produits</h1>






                    <div>
                        
                    </div>



                </div>
                <!--liste debut-->

                <div>




                    <?php if (isset($_GET['ajout']) && $_GET['ajout'] == "ok") {
                        print ' <div class="alert alert-success">
                        categorie ajouté avec succes

                     </div>';
                    }

                    ?>

                    <?php if (isset($_GET['delete']) && $_GET['delete'] == "ok") {
                        print ' <div class="alert alert-success">
                        categorie sup avec succes

                     </div>';
                    }

                    ?>

                    <?php if (isset($_GET['modif']) && $_GET['modif'] == "ok") {
                        print ' <div class="alert alert-success">
                        categorie modif avec succes

                     </div>';
                    }
                    ?>
                    <?php if (isset($_GET['erreur']) && $_GET['erreur'] == "duplicate") { //ajout
                        print ' <div class="alert alert-danger">
                        categorie existe 

                     </div>';
                    }

                    ?>




                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom du Produit</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            foreach ($stocks as $s) {
                                print '
                                <tr>
                                <th scope="row">' . $c['id'] . '</th>
                                <td>' . $s['nom'] . '</td>
                                <td>' . $s['description'] . '</td>
                                <td>
                                    
                                    <a  data-bs-toggle="modal" data-bs-target="#editModal' . $s['id'] . '" class="btn btn-success">modifier</a>
                                      


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



    <!-- Modal Ajout -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout Categorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="ajout.php" method="post" id="addform">
                        <div class="form-group" id="blocknom">
                            <input type="text" id="nom" name="nom" class="form-control" placeholder="nom cat">

                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="description categorie"></textarea>

                        </div>



                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">ajouter</button>
                </div>
                </form>









            </div>
        </div>

    </div>



    <?php
    foreach ($categories as $index => $categorie) { ?>

        <!-- Modal Modification -->

        <div class="modal fade" id="editModal<?php echo $categorie['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">modifier Categorie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="modifier.php" method="post">
                            <input type="hidden" value="<?php echo $categorie['id']; ?>" name="idc" />
                            <div class="form-group">
                                <input type="text" name="nom" class="form-control" value="<?php echo $categorie['nom']; ?>" placeholder="nom cat">

                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control" placeholder="description categorie"> <?php echo $categorie['description']; ?> </textarea>

                            </div>


                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">modifier</button>
                    </div>
                    </form>
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

            return confirm("voulez vous vraiment supprimer la categorie?");

        }
    </script>
</body>

</html>