<?php

session_start();

$dataBase =  new PDO('mysql:host=x71jz.myd.infomaniak.com;dbname=x71jz_tcorp','x71jz_tcorp','tcorpandco2020');

//  $dataBase = new PDO('mysql:host=localhost;dbname=db_tcorp','root','');

  $query = $dataBase->query('SELECT * FROM formation');

     if(isset($_GET['id']) and isset($_GET['option'])){



          if($_GET['option'] == 'suprimer'){


              $delete = $dataBase->exec('DELETE FROM formation WHERE id_formation='.$_GET['id']);
          }


     }

  ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Formation</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="../css/bootstrap.css">
  <!-- Material Design Bootstrap -->
  <!-- <link rel="stylesheet" href="../css/mdb.min.css"> -->
  <link rel="icon" type="text/css" href="../logo/logo_tcorpandco.png">
  <style>

    .pt-3-half {

      padding-top: 1.4rem;

    }

    body{

      text-decoration-style: solid;
    }

  </style>

  <script>

  </script>
</head>
<body>
<!-- Editable table -->
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">DONNEES FORMATIONS</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
        <tr>
          <th class="text-center">Nom et prenoms du candidat</th>
          <th class="text-center">Numéro du candidat</th>
          <th class="text-center">Email du candidat</th>
          <th class="text-center">Formation(s)</th>
          <th class="text-center">Niveau</th>
          <th class="text-center">Objectif</th>
          <th class="text-center">Disponibilité</th>
          <th class="text-center">Habition</th>
          <th class="text-center">Date d'inscription</th>
        </tr>
        </thead>
        <tbody>


        <?php

        while($print = $query->fetch()){

          ?>

          <tr>
            <td class="pt-3-half" contenteditable="true"><?= $print['nom_prenoms'] ?></td>
            <td class="pt-3-half" contenteditable="true"><?= $print['telephone']?></td>
            <td class="pt-3-half" contenteditable="true"><?= $print['email']?></td>
            <td class="pt-3-half" contenteditable="true"><?= $print['contenu_formation']?></td>
            <td class="pt-3-half" contenteditable="true"><?= $print['niveau']?></td>
            <td class="pt-3-half" contenteditable="true"><?= $print['objectif']?></td>
            <td class="pt-3-half" contenteditable="true"><?= $print['disponibilite']?></td>
            <td class="pt-3-half" contenteditable="true"><?= $print['habitation']?></td>
            <td class="pt-3-half" contenteditable="true"><?= $print['date_inscription']?></td>

            <td>
			  <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0"><a href="formationViewer.php?id='<?=  $print['id_formation']?>'&amp;option=suprimer" style="text-decoration: none; color: white">Suprimer</a></button></span>
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

