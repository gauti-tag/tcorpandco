<?php


class utilitaires
{

    public static function Mailing($from_nom,$from_email,$reply_to,$message,$objet,$destinataire, $from_website, $from_email_website,$objetWebsite,$contenPro){


        $headers ='From: "'.$from_nom.'"<'.$from_email.'>'."\n";
        $headers .='Reply-To: '.$reply_to.''."\n";
        $headers .='Content-Type: text/html; charset="utf-8"'."\n";
        $headers .='Content-Transfer-Encoding: 8bit';

       if(mail($destinataire, $objet, $message, $headers)){

           $contenu=file_get_contents($contenPro.'.html');

           $headersBIS ='From: "'.$from_website.'"<'.$from_email_website.'>'."\n";
           $headersBIS .='Reply-To: '.$reply_to.''."\n";
           $headersBIS .='Content-Type: text/html; charset="utf-8"'."\n";
           $headersBIS .='Content-Transfer-Encoding: 8bit';

           mail($from_email, $objetWebsite, $contenu, $headersBIS);


       }
        

    }
  
  public static function MailingPdf($from_nom,$from_email,$reply_to,$message,$objet,$destinataire, $from_website, $from_email_website,$objetWebsite,$contenPro){


        $headers ='From: "'.$from_nom.'"<'.$from_email.'>'."\n";
        $headers .='Reply-To: '.$reply_to.''."\n";
        $headers .='Content-Type: text/html; charset="utf-8"'."\n";
        $headers .='Content-Transfer-Encoding: 8bit';

       if(mail($destinataire, $objet, $message, $headers)){

           $contenu = $contenPro;

           $headersBIS ='From: "'.$from_website.'"<'.$from_email_website.'>'."\n";
           $headersBIS .='Reply-To: '.$reply_to.''."\n";
           $headersBIS .='Content-Type: text/html; charset="utf-8"'."\n";
           $headersBIS .='Content-Transfer-Encoding: 8bit';

           mail($from_email, $objetWebsite, $contenu, $headersBIS);


       }
        

    }


  



    public static function emailPRO($from_nom,$from_email,$reply_to,$message,$objet,array $destinataires=array()){
	  
        $contenu = file_get_contents($message.'.html');
        $headers ='From: "'.$from_nom.'"<'.$from_email.'>'."\n";
        $headers .='Reply-To: '.$reply_to.''."\n";
        $headers .='Content-Type: text/html; charset="utf-8"'."\n";
        $headers .='Content-Transfer-Encoding: 8bit';

        $destinataire="";
        foreach($destinataires as $value){
            //$destinataire.=''.$value.',';
            mail($value, $objet, $contenu, $headers)	;
        }

        //mail($destinataire, $objet, $contenu, $headers)	;

    }


    private static $var;

    public static function VerifInput($var){

        $var = trim($var);
        $var = htmlspecialchars($var);
        $var = stripcslashes($var);
        self::$var = $var;
        return self::$var;
    }

    public static function IsEmail($var){

        $var = filter_var($var,FILTER_VALIDATE_EMAIL);
        self::$var = $var;
        return self::$var;

    }
    public static function IsPhone($var){

        $var = preg_match('/^[0-9 ]*$/',$var);
        self::$var = $var;
        return self::$var;

    }

}