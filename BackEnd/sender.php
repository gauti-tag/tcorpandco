<?php

    require_once ('../utilitaires.php');

      $donnee = array("dataBase"=>" ","nomDemandeur"=>" ","periodeEvent"=>"","opt"=>"","prixOption"=>array('option_detail'=>' '),"totalPrixOption"=>"","dateEvent"=>"",
          "numeroDemandeur"=>" ","email"=>"","dateInscription"=>"","valide"=>false,"nomDemandeurError"=>"","numeroDemandeurError"=>"","emailError"=>"",
          "periodeEventError"=>"","dateEventError"=>"","req"=>" ","optError"=>" ","totalPrixOptionError"=>" ","tarif"=>array('tarif_detail'=> ' '),"tarifError"=>" ","ref_devis"=>" ");


       if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)){

           try{

               $donnee['dataBase'] =  new PDO('mysql:host=x71jz.myd.infomaniak.com;dbname=x71jz_tcorp','x71jz_tcorp','tcorpandco2020');

			 // $donnee['dataBase'] =  new PDO('mysql:host=localhost;dbname=db_tcorp','root','');

               $donnee['dataBase']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

               $donnee['nomDemandeur'] = utilitaires::VerifInput($_POST['nom']);
               $donnee['periodeEvent'] = utilitaires::VerifInput($_POST['jour']);
               $donnee['opt'] = utilitaires::VerifInput($_POST['nbre']);
               $donnee['prixOption']['option_detail'] = utilitaires::VerifInput($_POST['detail']);
               $donnee['tarif']['tarif_detail'] = utilitaires::VerifInput($_POST['detail1']);
               $donnee['totalPrixOption'] = utilitaires::VerifInput($_POST['somme']);
               $donnee['dateEvent'] = utilitaires::VerifInput($_POST['eventDate']);
               $donnee['numeroDemandeur'] = utilitaires::VerifInput($_POST['tel']);
               $donnee['email']             = utilitaires::VerifInput($_POST['email']);
               $donnee['dateInscription'] = date('Y-m-d H:i:s');
               $donnee['valide'] = true;

               $donnee['ref_devis']= "TCORP-A".rand(100,99999);
			 
			 
			 
			 /*  $pdf ="
		   
		         non:$donnee['nomDemandeur']
		   
		   ";*/




          //  utilitaires::Mailing($donnee['nomDemandeur'],$donnee['email'],$donnee['email'],'','','TCORPANDCO','tcorpandco.com','service@tcorpandco.com','DEVIS','client.php');
			 //   utilitaires::MailingPdf($donnee['nomDemandeur'],$donnee['email'],$donnee['email'],'', 'DEVIS-TCORPANDCO','services@tcorpandco.com', 'TCORPANDCO','services@tcorpandco.com','😍 Merci de nous faire confiance','$pdf');





           }catch(PDOException $e){

               print 'error'. $e->getMessage(). '<br/>';

           }
       }



       if(empty($donnee['nomDemandeur'])){

           $donnee['nomDemandeurError'] =" Entrer votre nom svp!";
           $donnee['valide'] = false;

       }
      if(empty($donnee['periodeEvent'])  /* OR !is_integer($donnee['periodeEvent'])*/){

           $donnee['periodeEventError'] = "Préciser le nombre de jour svp!";
           $donnee['valide'] = false;

       }
       if(!utilitaires::IsPhone($donnee['numeroDemandeur']) OR strlen($donnee['numeroDemandeur']) < 8){

           $donnee['numeroDemandeurError'] = "Entrer un bon numero svp!";
           $donnee['valide']= false;
       }
       if(!utilitaires::IsEmail($donnee['email'])){

           $donnee['emailError'] = 'Indiquer un bon email svp!';
           $donnee['valide'] = false;

       }

     $date = date('Y-m-d');

       if (empty($donnee['dateEvent'])  OR $donnee['dateEvent'] <= $date){

           $donnee['dateEventError'] = 'Attention vérifiez votre date svp!';
           $donnee['valide'] = false;

       }
       if(empty($donnee['opt']) and empty($donnee['totalPrixOption'])){

           $donnee['optError'] = $donnee['totalPrixOptionError'] = 'Cochez au minimum une prestation svp!';
           $donnee['valide'] = false;

       }


        if($donnee['valide']){

            $donnee['req']= "INSERT INTO event (ref_devis,nomDemandeur,periodeEvent,optionEvent,prixOption,tarifOption,totalPrixOption,dateEvent,numeroDemandeur,email_adresse,dateInscription)
                                    VALUES (:ref_devis,:nomDemandeur,:periodeEvent,:optionEvent,:prixOption,:tarifOption,:totalPrixOption,:dateEvent,:numeroDemandeur,:email_adresse,:dateInscription)";


            $donnee['r'] = $donnee['dataBase']->prepare($donnee['req']);

            $donnee['r']->execute(array(

                "ref_devis"=>$donnee['ref_devis'],
                "nomDemandeur"=> $donnee['nomDemandeur'],
                "periodeEvent"=>$donnee['periodeEvent'],
                "optionEvent"=> $donnee['opt'],
                "prixOption"=>  $donnee['prixOption']['option_detail'],
                "tarifOption"=>  $donnee['tarif']['tarif_detail'],
                "totalPrixOption"=> $donnee['totalPrixOption'],
                "dateEvent"=> $donnee['dateEvent'],
                "numeroDemandeur"=> $donnee['numeroDemandeur'],
                "email_adresse"=>$donnee['email'],
                "dateInscription"=>$donnee['dateInscription']

            ));

		  


        }


         echo json_encode($donnee);

 
 $dataBase =  new PDO('mysql:host=x71jz.myd.infomaniak.com;dbname=x71jz_tcorp','x71jz_tcorp','tcorpandco2020');
   $req = $dataBase->query("SELECT * FROM event WHERE idDemandeur = (SELECT MAX(idDemandeur) FROM event)");
   $affihe = $req->fetch();

      $prestation = explode('/',$affihe['prixOption']);
        $tarif = explode('/',$affihe[ 'tarifOption']) ;



   function afficher($variable){
      $aff = '';
       foreach ($variable as $key =>$value){

          $aff .= "$value<br>";
       }
        return $aff;
  }

function format_monetaire($argent){

          $fmt = new NumberFormatter('ru_RU',NumberFormatter::CURRENCY);
          $format = $fmt->formatCurrency( $argent,'XOF');
          return $format;
      }


$pdf="<body style=\"width: 700px; margin: 0 auto\">
    <!--========= first line ===============-->


         <table valign=\"top\">

            <tr><td style=\"height: 5rem\"><table><tr><td><table><tr><td><img  width=\"100\" height=\"100\" style=\"height:10px\" alt=\"\" src=\"https://www.tcorpandco.com/logo/logo_tcorpandco.png\"> </td></tr></table></td></tr></table></td></tr>
            <tr><td>Angré Djibi, Abidjan</td></tr>
            <tr><td>services@tcorpandco.com</td></tr>
            <tr><td>+225 22 59 23 20 / 22 50 26 64</td><td></td></tr>


        </table>
    <div style=\"height: 20px; color: white\"></div>

         <table align=\"right\">
           <tr><td style=\"font-size: 40px; background-color: #4e4e4e; color: white; border-radius: 10px\">DEVIS</td></tr>
         </table>

             <div style=\"height: 20px\"></div>
    <!--========= End first line ===============-->



          <table><tr><td>
                <table align=\"left\">
                    <tr><td>Référence:</td><td><b> ".$affihe['ref_devis']."</b></td></tr>
                    <tr><td>Date d'inscription:</td><td><b>".$affihe['dateInscription']."</b></td></tr>
                    <tr><td>Date de réservation:</td><td><b>".$affihe['dateEvent']."</b></td></tr>
				    <tr><td>Période d'exécution:</td><td><b>". $affihe['periodeEvent'] ."  jour(s)</b></td></tr>
                </table>
            </td></tr>

            <tr><td> <div style=\"height: 20px; color: white\"></div></td></tr>

             

                 <tr><td>


                <table align=\"right\">
                    <tr><td>Nom Client:</td><td><b>". strtoupper($affihe['nomDemandeur'])."</b></td></tr>
                    <tr><td>Tel Client:</td><td><b>".$affihe['numeroDemandeur']."</b></td></tr>
                    <tr><td>Email Client: </td><td><b>".$affihe['email_adresse']."</b></td></tr>
                </table>

                 </td>
                 </tr>


          </table>

  <table align=\"center\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"table\" style=\"border-collapse: collapse; text-align: center\">

            <tr>
                <td bgcolor=\"#aedafb\" class=\"th\" style=\"color:#4e5f6e; font-family:Arial; font-size:14px; line-height:18px; text-align:center; font-weight: bold; border: 1px solid #6abbfa\">Désignation</td>
                <td bgcolor=\"#aedafb\" class=\"th\" style=\"color:#4e5f6e; font-family:Arial; font-size:14px; line-height:18px; text-align:center; font-weight: bold; border: 1px solid #6abbfa\">Quantité au choix</td>
                <td bgcolor=\"#aedafb\" class=\"th\" style=\"color:#4e5f6e; font-family:Arial; font-size:14px; line-height:18px; text-align:center; font-weight: bold; border: 1px solid #6abbfa\">Prix unitaire Par choix</td>
                <td bgcolor=\"#aedafb\" class=\"th\" style=\"color:#4e5f6e; font-family:Arial; font-size:14px; line-height:18px; text-align:center; font-weight: bold; border: 1px solid #6abbfa\">Prix total HT</td>

            </tr>

            <tr>
                <td bgcolor=\"#e1f2ff\" class=\"td\" style=\"color:#4b5b69; font-family:Arial; font-size:12px; line-height:16px; text-align:left; border: 1px solid #6abbfa; padding: 2px 2px\">".afficher($prestation)."<br></td>
                <td bgcolor=\"#e1f2ff\" class=\"td-center\" style=\"color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:center; border: 1px solid #6abbfa; padding: 2px 2px\">".$affihe['optionEvent']."</td>
                <td bgcolor=\"#e1f2ff\" class=\"td-right\" style=\"color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px\">".afficher($tarif)."<br></td>
                 
                <td bgcolor=\"#e1f2ff\" class=\"td-right\" style=\"color:#4b5b69; font-family:Arial; font-size:14px; line-height:18px; text-align:right; border: 1px solid #6abbfa; padding: 2px 5px\">".

                  format_monetaire($affihe['totalPrixOption'])

                    ."</td>
              </tr>

        </table>

        <br><br>

             <table><tr><td style=\"text-align: center\">
    Nous restons à votre disposition pour toute information complémentaire.<br>
    Cordialement,
    Si ce devis vous convient, veuillez nous le retourner signé précédé de la mention : <br><br>
             </td></tr></table>
    BON POUR ACCORD ET EXECUTION DU DEVIS <br><br>


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


       <table valign=\"center\" align=\"center\">
          <tr><td style=\"text-align: center\">
        TCORP & CO, situé à angré 8 -ème tranche, Djibi 1 non loin du carrefour Mandela<br>
        RC N CI-ABJ-2018-A 32195 – CC N 1293101 T<br>
        TEL : +225 22 59 23 20 / 22 50 26 64 – Email : services@tcorpandco.com

              </td></tr>
       </table>


</body>

";

 utilitaires::MailingPdf($affihe['nomDemandeur'] ,$affihe['email_adresse'],$affihe['email_adresse'], '', '','services@tcorpandco.com', 'TCORPANDCO','services@tcorpandco.com','DEVIS',$pdf);

