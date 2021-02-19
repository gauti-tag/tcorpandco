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



           }catch(PDOException $e){

               print 'error'. $e->getMessage(). '<br/>';

           }
       }



       if(empty($donnee['nomDemandeur'])){

           $donnee['nomDemandeurError'] =" Entrer votre nom svp!";
           $donnee['valide'] = false;

       }
      if(empty($donnee['periodeEvent'])  /* OR !is_integer($donnee['periodeEvent'])*/){

           $donnee['periodeEventError'] = "Entrer une periode svp!";
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





		   utilitaires::MailingPdf($donnee['nomDemandeur'],$donnee['email'],$donnee['email'],'','','TCORPANDCO','tcorpandco.com','service@tcorpandco.com','DEVIS TCORPANDCO, merci d\'avoir opter pour le meilleur','pdf');



        }


         echo json_encode($donnee);



