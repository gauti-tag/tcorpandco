<?php

        $dataBase =  new PDO('mysql:host=x71jz.myd.infomaniak.com;dbname=x71jz_tcorp','x71jz_tcorp','tcorpandco2020');

        $req = $dataBase->query("SELECT * FROM event");

        if(isset($_GET['id']) and isset($_GET['option'])){



                 if($_GET['option'] == 'suprimer'){



                     $res = $dataBase->exec('DELETE FROM event WHERE idDemandeur='.$_GET['id']);




                 }
        }

       // utilitaires::MessagePro();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Données</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!-- Material Design Bootstrap -->
   <!-- <link rel="stylesheet" href="../css/mdb.min.css"> -->

    <style>

        .pt-3-half {
            padding-top: 1.4rem;
        }
        body{

            text-decoration-style: solid;
        }

    </style>

    <script>
        const $tableID = $('#table');
        const $BTN = $('#export-btn');
        const $EXPORT = $('#export');

        const newTr = `
  <tr class="hide">
  <td class="pt-3-half" contenteditable="true">Example</td>
  <td class="pt-3-half" contenteditable="true">Example</td>
  <td class="pt-3-half" contenteditable="true">Example</td>
  <td class="pt-3-half" contenteditable="true">Example</td>
  <td class="pt-3-half" contenteditable="true">Example</td>
  <td class="pt-3-half">
    <span class="table-up"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-up" aria-hidden="true"></i></a></span>
    <span class="table-down"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-down" aria-hidden="true"></i></a></span>
  </td>
  <td>
    <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0 waves-effect waves-light">Remove</button></span>
  </td>
</tr>`;

        $('.table-add').on('click', 'i', () => {

            const $clone = $tableID.find('tbody tr').last().clone(true).removeClass('hide table-line');

            if ($tableID.find('tbody tr').length === 0) {

                $('tbody').append(newTr);
            }

            $tableID.find('table').append($clone);
        });

        $tableID.on('click', '.table-remove', function () {

            $(this).parents('tr').detach();
        });

        $tableID.on('click', '.table-up', function () {

            const $row = $(this).parents('tr');

            if ($row.index() === 1) {
                return;
            }

            $row.prev().before($row.get(0));
        });

        $tableID.on('click', '.table-down', function () {

            const $row = $(this).parents('tr');
            $row.next().after($row.get(0));
        });

        // A few jQuery helpers for exporting only
        jQuery.fn.pop = [].pop;
        jQuery.fn.shift = [].shift;

        $BTN.on('click', () => {

            const $rows = $tableID.find('tr:not(:hidden)');
            const headers = [];
            const data = [];

            // Get the headers (add special header logic here)
            $($rows.shift()).find('th:not(:empty)').each(function () {

                headers.push($(this).text().toLowerCase());
            });

            // Turn all existing rows into a loopable array
            $rows.each(function () {
                const $td = $(this).find('td');
                const h = {};

                // Use the headers from earlier to name our hash keys
                headers.forEach((header, i) => {

                    h[header] = $td.eq(i).text();
                });

                data.push(h);
            });

            // Output the result
            $EXPORT.text(JSON.stringify(data));
        });

    </script>
</head>
<body>
            <!-- Editable table -->
            <div class="card">
                <h3 class="card-header text-center font-weight-bold text-uppercase py-4">DONNEES VOTRE MANIF</h3>
                <div class="card-body">
                    <div id="table" class="table-editable">
                  <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
                        <table class="table table-bordered table-responsive-md table-striped text-center">
                            <thead>
                            <tr>
                                <th class="text-center">Nom du client</th>
                                <th class="text-center">Numéro du client</th>
							    <th class="text-center">Email du client</th>
                                <th class="text-center">Options selectionnées</th>
                                <th class="text-center">Période de l'évènement</th>
                                <th class="text-center">Date de l'évènement</th>
                                <th class="text-center">Detail prix option</th>
                                <th class="text-center">Total prix</th>
                                <th class="text-center">Date d'édition</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            while($affiche = $req->fetch()){

                            ?>

                            <tr>
                                <td class="pt-3-half" contenteditable="true"><?= $affiche['nomDemandeur'] ?></td>
                                <td class="pt-3-half" contenteditable="true"><?= $affiche['numeroDemandeur']?></td>
							    <td class="pt-3-half" contenteditable="true"><?= $affiche['email_adresse']?></td>
                                <td class="pt-3-half" contenteditable="true"><?= $affiche['optionEvent']?></td>
                                <td class="pt-3-half" contenteditable="true"><?= $affiche['periodeEvent']?></td>
                                <td class="pt-3-half" contenteditable="true"><?= $affiche['dateEvent']?></td>
                                <td class="pt-3-half" contenteditable="true"><?= $affiche['prixOption']?></td>
                                <td class="pt-3-half" contenteditable="true"><?= $affiche['totalPrixOption']?></td>
                                <td class="pt-3-half" contenteditable="true"><?= $affiche['dateInscription']?></td>

                                <td>
                                     <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0"><a href="viewer.php?id='<?= $affiche['idDemandeur']?>'&amp;option=suprimer" style="text-decoration: none; color: white"> Suprimer </a></button></span>
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

