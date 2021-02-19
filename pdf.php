<?php


    //$dataBase =  new PDO('mysql:host=localhost;dbname=db_tcorp','root','');
   $dataBase =  new PDO('mysql:host=x71jz.myd.infomaniak.com;dbname=x71jz_tcorp','x71jz_tcorp','tcorpandco2020');
   $req = $dataBase->query("SELECT * FROM event WHERE idDemandeur = (SELECT MAX(idDemandeur) FROM event)");
   $affihe = $req->fetch();
   // var_dump($affihe);


    function format_monetaire($argent){

          $fmt = new NumberFormatter('ru_RU',NumberFormatter::CURRENCY);
          $format = $fmt->formatCurrency( $argent,'XOF');
          return $format;
      }
?>


<body style="width: 700px; margin: 0 auto">




    <!--========= first line ===============-->


         <table valign="top">

            <tr><td style="height: 5rem"><table><tr><td><table><tr><td><img  width="100" height="100" style="height:10px" alt="" src="logo/logo_tcorpandco.png"> </td></tr></table></td></tr></table></td></tr>
            <tr><td>Angré Djibi, Abidjan</td></tr>
            <tr><td>services@tcorpandco.com</td></tr>
            <tr><td>+225 22 59 23 20 / 22 50 26 64</td><td></td></tr>


        </table>
    <div style="height: 20px; color: white"></div>

         <table align="right">
           <tr><td style="font-size: 40px; background-color: #4e4e4e; color: white; border-radius: 10px">DEVIS</td></tr>
         </table>

             <div style="height: 20px"></div>
    <!--========= End first line ===============-->



          <table><tr><td>
                <table align="left">
                    <tr><td>Référence:</td><td><b><?php echo $affihe['ref_devis'];?></b></td></tr>
                    <tr><td>Date d'inscription:</td><td><b><?php echo $affihe['dateInscription'];?></b></td></tr>
                    <tr><td>Date de réservation:</td><td><b><?= $affihe['dateEvent'];?></b></td></tr>
				    <tr><td>Période d'exécution:</td><td><b><?= $affihe['periodeEvent'];?>  jour(s)</b></td></tr>
                </table>
            </td></tr>

            <tr><td> <div style="height: 20px; color: white"></div></td></tr>

             <!--    <table align="right" style="float: right; position: absolute; margin-left: 20px" >
                     <tr><td style="font-size: 20px; background-color: #4e4e4e; color: white">DEVIS</td></tr>
                 </table>  -->

                 <tr><td>


                <table align="right">
                    <tr><td>Nom Client:</td><td><b><?= strtoupper($affihe['nomDemandeur']);?></b></td></tr>
                    <tr><td>Tel Client:</td><td><b><?= $affihe['numeroDemandeur'];?></b></td></tr>
                    <tr><td>Email Client: </td><td><b><?= $affihe['email_adresse'];?></b></td></tr>
                </table>

                 </td>
                 </tr>


          </table>

    <!--  <table width="400">
         <tr>
             <td align="left">
         <table>
             <tr><td>Référence:</td><td></td></tr>
             <tr><td>Date d'inscription:</td><td></td></tr>
             <tr><td>Date de réservation:</td><td></td></tr>

         </table>
             </td>
             <td align="right">
         <table>

             <tr><td>Nom Client:</td><td></td></tr>
             <tr><td>Tel Client:</td><td></td></tr>
             <tr><td>Email Client: </td><td></td></tr>

         </table>
             </td>
         </tr>
         </table>  -->

         <!--========= End second line ===============-->



  <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="table" style="border-collapse: collapse; text-align: center">

            <tr>
                <td bgcolor="#aedafb" class="th" style="color:#4e5f6e; font-family:Arial; font-size:14px; line-height:18px; text-align:center; font-weight: bold; border: 1px solid #6abbfa">Désignation</td>
                <td bgcolor="#aedafb" class="th" style="color:#4e5f6e; font-family:Arial; font-size:14px; line-height:18px; text-align:center; font-weight: bold; border: 1px solid #6abbfa">Quantité au choix</td>
                <td bgcolor="#aedafb" class="th" style="color:#4e5f6e; font-family:Arial; font-size:14px; line-height:18px; text-align:center; font-weight: bold; border: 1px solid #6abbfa">Prix unitaire Par choix</td>
                <td bgcolor="#aedafb" class="th" style="color:#4e5f6e; font-family:Arial; font-size:14px; line-height:18px; text-align:center; font-weight: bold; border: 1px solid #6abbfa">Prix total HT</td>

            </tr>

            <tr>
                <td bgcolor="#e1f2ff" class="td" style="color:#4b5b69; font-family:Arial; font-size:12px; line-height:16px; text-align:left; border: 1px solid #6abbfa; padding: 2px 2px"><?php

                   $a = explode('/',$affihe['prixOption']);
                      foreach ($a as $key => $value)
                          echo "$value<br>";


                    ?></td>
                <td bgcolor="#e1f2ff" class="td-center" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:center; border: 1px solid #6abbfa; padding: 2px 2px"><?=

                   $affihe['optionEvent'] ;

                    ?></td>
                <td bgcolor="#e1f2ff" class="td-right" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px"><?php

                    $b = explode('/',$affihe['tarifOption']) ;
                    foreach ($b as $key => $value)
                        echo "$value<br>";
                    ?></td>
                <td bgcolor="#e1f2ff" class="td-right" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px"><?=

                    format_monetaire($affihe['totalPrixOption']) ;

                    ?></td>
              </tr>


             <!--<tr>
                <td bgcolor="#e1f2ff" class="td" style="color:#4b5b69; font-family:Arial; font-size:12px; line-height:16px; text-align:left; border: 1px solid #6abbfa; padding: 2px 2px">Web Jumbo plakat na <a href="http://www.jumbo.hr" target="_blank" class="link-3" style="color:#3300ff; text-decoration:none"><span class="link-3" style="color:#3300ff; text-decoration:none">www.jumbo.hr</span></a><br /> ( BESPLATNO )</td>
                <td bgcolor="#e1f2ff" class="td-center" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:center; border: 1px solid #6abbfa; padding: 2px 2px">1</td>
                <td bgcolor="#e1f2ff" class="td-right" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px">819.67</td>
                <td bgcolor="#e1f2ff" class="td-right" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px">-819.67</td>

            </tr>
            <tr>
                <td bgcolor="#e1f2ff" class="td" style="color:#4b5b69; font-family:Arial; font-size:12px; line-height:16px; text-align:left; border: 1px solid #6abbfa; padding: 2px 2px">Designation 3</td>
                <td bgcolor="#e1f2ff" class="td-center" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:center; border: 1px solid #6abbfa; padding: 2px 2px">1</td>
                <td bgcolor="#e1f2ff" class="td-right" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px">422.00</td>
                <td bgcolor="#e1f2ff" class="td-right" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px">0</td>

            </tr>-->

        </table>

        <br><br>

        <!--  <table align="right">

                <table width="300" border="0" cellspacing="0" cellpadding="0" class="table" style="border-collapse: collapse">
                    <tr>
                        <td width="137" bgcolor="#e1f2ff" class="td-right" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px">Total Hors Taxe:</td>
                        <td bgcolor="#e1f2ff" class="td-right" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px">1335.44</td>
                    </tr>

                    <tr>
                        <td bgcolor="#e1f2ff" class="td-right" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px">TVA à 18%</td>
                        <td bgcolor="#e1f2ff" class="td-right" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px">110.50</td>
                    </tr>
                </table>

                     <div style="font-size:0pt; line-height:0pt; height:10px"></div>

                <table width="300" border="0" cellspacing="0" cellpadding="0" class="table" style="border-collapse: collapse">
                    <tr>
                        <td width="137" bgcolor="#aedafb" class="td-right" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px"><strong>Total TTC en f CFA:</strong></td>
                        <td bgcolor="#e1f2ff" class="td-right" style="color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px"><strong>552.50</strong></td>
                    </tr>
                </table>

        </table> -->
             <table><tr><td style="text-align: center">
    Nous restons à votre disposition pour toute information complémentaire.<br>
    Cordialement,
    Si ce devis vous convient, veuillez nous le retourner signé précédé de la mention : <br><br>
             </td></tr></table>
    "BON POUR ACCORD ET EXECUTION DU DEVIS" <br><br>


       <table>
           <tr>
               <td>Date :</td>
           </tr>

       </table>

    <table>
        <tr>
            <td>Signature :</td>
        </tr>

    </table>

<br><br>

        Validité du devis : 1 semaine <br>
        Conditions de reglement : 70% à la commande , le solde à la livraison<br>
       <!-- Toute somme non payée à sa date d'exigibilité produira de plein droit des intérêts de retard, <br> dont le paiement d'une somme de 30 000f due au titre des frais de recouvrement-->

<hr>


       <table valign="center" align="center">
          <tr><td style="text-align: center">
        TCORP & CO, situé à angré 8 -ème tranche, Djibi 1 non loin du carrefour Mandela<br>
        RC N CI-ABJ-2018-A 32195 – CC N 1293101 T<br>
        TEL : +225 22 59 23 20 / 22 50 26 64 – Email : services@tcorpandco.com

              </td></tr>
       </table>


</body>



