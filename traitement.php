<?php

  //echo 'Email envoyé ';


require_once ('utilitaires.php');


    $nom = $_POST['name'];
    $email = $_POST['email'];
    $subj = $_POST['subject'];
    $sms = $_POST['message'];


    if(isset($_POST['name'])){
	  



	  //  utilitaires::MailingInterne( $nom ,$email,$email, $sms, $subj,'services@tcorpandco.com', 'TCORPANDCO','services@tcorpandco.com','Bientôt Pâquinou ! Faites-vous livrer vos équipements chez vous', $htlm);

	  
	 utilitaires::Mailing($nom ,$email,$email, $sms, $subj,'services@tcorpandco.com', 'TCORPANDCO','services@tcorpandco.com','😍 Du nouveau sur vetparis ! Faites-vous livrer vos équipements chez vous','test');

              //$from_nom,$from_email,$reply_to,$message,$objet,$destinataire, $from_website, $from_email_website,$objetWebsite

        echo 'Email envoyé avec sucess ';
	  
	  
	}else{
	  
	  
	  echo 'Email non envoyé ';
	  
	}







