<?php
  require_once ('../utilitaires.php');

$communication = array("dataBase"=>"","object"=>"","date"=>"","nom"=>"","phone"=>"","email"=>"","valider"=>false,"objectError"=>"","dateError"=>"","nomError"=>"","phoneError"=>"","emailError"=>"","req"=>"","r"=>"");



       if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)){



                  try{
                         $communication['dataBase'] =  new PDO('mysql:host=x71jz.myd.infomaniak.com;dbname=x71jz_tcorp','x71jz_tcorp','tcorpandco2020');
					//  $communication['dataBase'] = new PDO('mysql:host=localhost;dbname=db_tcorp','root','');
                      $communication['dataBase']->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


                      $communication['object'] = utilitaires::VerifInput($_POST['object']);
                      $communication['date']  = utilitaires::VerifInput($_POST['date']);
                      $communication['nom'] =   utilitaires::VerifInput($_POST['nom']);
                      $communication['phone'] = utilitaires::VerifInput($_POST['phone']);
                      $communication['email'] = utilitaires::VerifInput($_POST['email']);


                      $communication['valider'] = true;


                  }catch (PDOException $e){

                      print 'erreur'.$e->getMessage().'<br>';
                  }


       }

       if(empty($communication['object'])){

           $communication['objectError'] = 'Aucune option selectionn&eacute!';
           $communication['valider'] = false;

       }

        $date = date('Y-m-d');

       if(empty($communication['date']) OR $communication['date'] <= $date){

           $communication['dateError'] = "Attention v&eacuterifier votre date";
           $communication['valider'] = false;

       }
       if(empty($communication['nom'])){

           $communication['nomError'] = 'Indiquer votre nom et prenoms svp!';
           $communication['valider'] = false;

       }
       if(!utilitaires::IsPhone($communication['phone']) OR strlen($communication['phone']) < 8){

           $communication['phoneError'] = 'Indiquer un bon numero svp!';
           $communication['valider'] = false;

         }

       if(!utilitaires::IsEmail($communication['email'])){

           $communication['emailError'] = 'Email non valide';
           $communication['valider'] = false;

       }



       if($communication['valider']){





           $communication['req'] = "INSERT INTO communication (objet,date_rdv,nom_prenoms,telephone,adresse_email,date_inscription)
                                                              VALUES (:objet,:date_rdv,:nom_prenoms,:telephone,:adresse_email,:date_inscription)";


           $communication['r'] = $communication['dataBase']->prepare($communication['req']);

           $communication['r']->execute(array(

               "objet"=>$communication['object'],
               "date_rdv"=>$communication['date'],
               "nom_prenoms"=>$communication['nom'],
               "telephone"=>$communication['phone'],
               "adresse_email"=>$communication['email'],
               "date_inscription"=>$date

           ));

       }


       echo json_encode($communication);