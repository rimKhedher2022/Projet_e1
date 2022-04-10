
<?php
include "inc/functions.php";
$showRegistrationAlert = 0 ; 
$categories = getAllCategorie();

if(!empty($_POST))
{
    if ( AddVisiteur($_POST))
    {
      $showRegistrationAlert = 1;
    }

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.8/sweetalert2.all.min.js">
</head>
<body>

   <?php
   include "inc/header.php";
   ?>
    
<!--fin navbar-->
<div class="col-12 p-5">
    <h1 class="text-center">registre</h1>
    <form action="registre.php" method="POST">
        <div class="mb-3">

          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">nom</label>
          <input type="text" name="nom" class="form-control" id="exampleInputPassword1">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">prenom</label>
          <input type="text"  name="prenom" class="form-control" id="exampleInputPassword1">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">tel</label>
          <input type="text" name="telephone" class="form-control" id="exampleInputPassword1">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" name="mp" class="form-control" id="exampleInputPassword1">
        </div>
       
        <button type="submit" class="btn btn-primary">sauvegarder</button>
      </form>

</div>



<!--footer-->
    <div class="bg-dark text-center p-5 mt-4">

        <p class="text-white">
            tou nnn 2022/2022
        </p>
    </div>
<!-- fin footer-->

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.8/sweetalert2.all.min.js"></script>

<?php
if($showRegistrationAlert == 1)
{
  print "
  <script>
  Swal.fire({
    title: 'Success',
    text: 'le compte est crée',
    icon: 'success',
    confirmButtonText: 'ok'
  })
  </script> 
  
  ";
}

?>



</html>