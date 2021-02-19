<?php

//$base = new PDO('mysql:host=localhost;dbname=db_tcorp','root','');
 $base =  new PDO('mysql:host=x71jz.myd.infomaniak.com;dbname=x71jz_tcorp','x71jz_tcorp','tcorpandco2020');

 $requete = $base->query('SELECT * FROM communication');


    if(isset($_GET['id']) and isset($_GET['option'])){


            if($_GET['option'] == 'suprimer'){

                $delete =$base->exec('DELETE FROM communication WHERE id='.$_GET['id']);

             /*   $delete = $base->prepare('DELETE FROM communication WHERE id=:id');

                $delete->execute(array(

                        "id"=>$_GET['id']

                    )); */
            }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Communication</title>

  <!-- Bootstrap core CSS -->

  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="icon" type="text/css" href="../logo/logo_tcorpandco.png">

  <style>

    .pt-3-half {
      padding-top: 1.4rem;
    }

    body{
      text-decoration-style: solid;
    }

  </style>

</head>

<body>

<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">DONNEES COMMUNICATION</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
        <tr>
          <th class="text-center">Nom et prenoms du client</th>
          <th class="text-center">Numéro du client</th>
          <th class="text-center">Email du client</th>
          <th class="text-center">Libelle Prestation</th>
          <th class="text-center">Date d'inscription</th>
        </tr>
        </thead>
        <tbody>
        <?php

        while($insert = $requete->fetch()){

          ?>
          <tr>
                    <td class="pt-3-half" contenteditable="true"><?= $insert['nom_prenoms'] ?></td>
                    <td class="pt-3-half" contenteditable="true"><?= $insert['telephone']?></td>
                    <td class="pt-3-half" contenteditable="true"><?= $insert['adresse_email']?></td>
                    <td class="pt-3-half" contenteditable="true"><?= $insert['objet']?></td>
                    <td class="pt-3-half" contenteditable="true"><?= $insert['date_inscription']?></td>
            <td>
              <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0"><a href="comViewer.php?id='<?= $insert['id'] ?>'&amp;option=suprimer" style="text-decoration: none; color: white">Suprimer</a></button></span>
            </td>
          </tr>

          <?php
        }

?>
</tbody>
</table>
</div>
</div>
</div>
<!-- Editable table -->
<!-- jQuery -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
</html>