<?php

  require_once '../utilitaires.php';


  $formation = array("dataBase"=>"","contenu_formation"=>"","nom_prenoms"=>"","telephone"=>"","email"=>"","niveau"=>"","objectif"=>"","disponibilite"=>"",

                     "habitation"=>"","etatcoche"=>"","valider"=>false,"contenu_formationError"=>"","nom_prenomsError"=>"","telephoneError"=>"","emailError"=>"","niveauError"=>"",

                     "objectifError"=>"","disponibiliteError"=>"","habitationError"=>"","etatcocheError"=>"","req"=>"","r"=>"");



      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)){

          try {

            //  $formation['dataBase'] =  new PDO('mysql:host=x71jz.myd.infomaniak.com;dbname=x71jz_tcorp','x71jz_tcorp','tcorpandco2020');
			 $formation['dataBase'] =  new PDO('mysql:host=localhost;dbname=db_tcorp','root','');
              $formation['dataBase']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $formation['contenu_formation'] = utilitaires::VerifInput($_POST['contenu_formation']);
              $formation['nom_prenoms'] = utilitaires::VerifInput($_POST['nom_prenoms']);
              $formation['telephone'] = utilitaires::VerifInput($_POST['telephone']);
              $formation['email'] = utilitaires::VerifInput($_POST['email']);
              $formation['niveau'] = utilitaires::VerifInput($_POST['niveau']);
              $formation['objectif'] = utilitaires::VerifInput($_POST['objectif']);
              $formation['disponibilite'] = utilitaires::VerifInput($_POST['disponibilite']);
              $formation['habitation'] = utilitaires::VerifInput($_POST['habitation']);
              $formation['etatcoche'] = utilitaires::VerifInput($_POST['etatcoche']);

              $formation['valider'] = true;

          }catch (PDOException $e){


              print 'error'.$e->getMessage().'<br>';

          }

      }


     if(empty($formation['contenu_formation'])){

           $formation['contenu_formationError'] = 'Oup! aucune formation selectionn&eacute';
           $formation['valider'] = false;

      }

   if($formation['contenu_formation'] == 'Photoshop' OR $formation['contenu_formation'] == 'Adobe Illustrator'

    OR $formation['contenu_formation'] == 'After Effects'  OR $formation['contenu_formation'] == 'Adobe Première Pro'){

       $formation['valider'] = true;

   }else{

       $formation['contenu_formationError'] = 'Oup! selectionner une correcte formation';
       $formation['valider'] = false;
   }



      if(empty($formation['nom_prenoms'])){

          $formation['nom_prenomsError'] ='Renseignez votre nom et prenoms svp!';
          $formation['valider'] = false;

      }
      if(!utilitaires::IsPhone($formation['telephone']) OR strlen($formation['telephone']) < 8){

          $formation['telephoneError'] = 'Entrer un bon num&eacutero de t&eacutel&eacutephone svp!';
          $formation['valider'] = false;

      }
      if(!utilitaires::IsEmail($formation['email'])){

          $formation['emailError'] = 'Indiquer un bon email svp!';
          $formation['valider'] = false;

      }
      if(empty($formation['niveau'])){

          $formation['niveauError'] = 'Selectionner votre niveau digital svp!';
          $formation['niveauError'] = false;
      }


      if(empty($formation['objectif'])){

          $formation['objectifError'] = 'Selectionner votre objectif svp! ';
          $formation['valider'] = false;
      }

     if(empty($formation['disponibilite'])){

    $formation['disponibiliteError'] = 'Selectionner le jour pour votre formation svp!';
    $formation['valider'] = false;
       }

    if(empty($formation['habitation'])){

        $formation['habitationError'] = "Indiquer votre lieu d'habitation svp!";
        $formation['valider'] = false;
    }

   if(empty($formation['etatcoche'])){

        $formation['etatcocheError'] = "Veillez cocher pour accepter de recevoir des mails et appels t&eacutel&eacutephoniques";
        $formation['valider'] = false;

    }



     if($formation['valider']){


              $email = '
             
                  <!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
    <style>
        /* -------------------------------------
            GLOBAL RESETS
        ------------------------------------- */

        /*All the styling goes here*/

        img {
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 100%;
        }

        body {
            background-color: #f6f6f6;
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%; }
        table td {
            font-family: sans-serif;
            font-size: 14px;
            vertical-align: top;
        }

        /* -------------------------------------
            BODY & CONTAINER
        ------------------------------------- */

        .body {
            background-color: #f6f6f6;
            width: 100%;
        }

        /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
        .container {
            display: block;
            margin: 0 auto !important;
            /* makes it centered */
            max-width: 580px;
            padding: 10px;
            width: 580px;
        }

        /* This should also be a block element, so that it will fill 100% of the .container */
        .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 580px;
            padding: 10px;
        }

        /* -------------------------------------
            HEADER, FOOTER, MAIN
        ------------------------------------- */
        .main {
            background: #ffffff;
            border-radius: 3px;
            width: 100%;
        }

        .wrapper {
            box-sizing: border-box;
            padding: 20px;
        }

        .content-block {
            padding-bottom: 10px;
            padding-top: 10px;
        }

        .footer {
            clear: both;
            margin-top: 10px;
            text-align: center;
            width: 100%;
        }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
            color: #999999;
            font-size: 12px;
            text-align: center;
        }

        /* -------------------------------------
            TYPOGRAPHY
        ------------------------------------- */
        h1,
        h2,
        h3,
        h4 {
            color: #000000;
            font-family: sans-serif;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 35px;
            font-weight: 300;
            text-align: center;
            text-transform: capitalize;
        }

        p,
        ul,
        ol {
            font-family: sans-serif;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 15px;
        }
        p li,
        ul li,
        ol li {
            list-style-position: inside;
            margin-left: 5px;
        }

        a {
            color: #3498db;
            text-decoration: underline;
        }

        /* -------------------------------------
            BUTTONS
        ------------------------------------- */
        .btn {
            box-sizing: border-box;
            width: 100%; }
        .btn > tbody > tr > td {
            padding-bottom: 15px; }
        .btn table {
            width: auto;
        }
        .btn table td {
            background-color: #ffffff;
            border-radius: 5px;
            text-align: center;
        }
        .btn a {
            background-color: #ffffff;
            border: solid 1px #3498db;
            border-radius: 5px;
            box-sizing: border-box;
            color: #3498db;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            padding: 12px 25px;
            text-decoration: none;
            text-transform: capitalize;
        }

        .btn-primary table td {
            background-color: #3498db;
        }

        .btn-primary a {
            background-color: #3498db;
            border-color: #3498db;
            color: #ffffff;
        }

        /* -------------------------------------
            OTHER STYLES THAT MIGHT BE USEFUL
        ------------------------------------- */
        .last {
            margin-bottom: 0;
        }

        .first {
            margin-top: 0;
        }

        .align-center {
            text-align: center;
        }

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .clear {
            clear: both;
        }

        .mt0 {
            margin-top: 0;
        }

        .mb0 {
            margin-bottom: 0;
        }

        .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0;
        }

        .powered-by a {
            text-decoration: none;
        }

        hr {
            border: 0;
            border-bottom: 1px solid #f6f6f6;
            margin: 20px 0;
        }

        /* -------------------------------------
            RESPONSIVE AND MOBILE FRIENDLY STYLES
        ------------------------------------- */
        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }
            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
                font-size: 16px !important;
            }
            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important;
            }
            table[class=body] .content {
                padding: 0 !important;
            }
            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
            }
            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }
            table[class=body] .btn table {
                width: 100% !important;
            }
            table[class=body] .btn a {
                width: 100% !important;
            }
            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }

        /* -------------------------------------
            PRESERVE THESE STYLES IN THE HEAD
        ------------------------------------- */
        @media all {
            .ExternalClass {
                width: 100%;
            }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }
            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }
            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }
            .btn-primary table td:hover {
                background-color: #34495e !important;
            }
            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }
        }

    </style>
</head>
<body class="">
<span class="preheader"> 😍 Bienvenue</span>
<table><tr align="center"><td><img width="560" height="100" src="https://www.tcorpandco.com/images/formation/baniere-formation2.jpg"></td></tr></table>
<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="margin-top: -28px">
    <tr>
        <td>&nbsp;</td>
        <td class="container">
            <div class="content">

                <!-- START CENTERED WHITE CONTAINER -->
                <table role="presentation" class="main">

                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                        <td class="wrapper">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <p><b> Bonjour </b> '. $formation["nom_prenoms"] .', </p>
                                        <p>Votre réservation aux programmes digitals à bien été prise en compte.</p>
										<p> <b> Tel:  +255 48 52 11 45 </b> </p>
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                            <tbody>
                                            <tr>
                                                <td align="left">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                        <tr>
                                                            <td> <a href="http://www.tcorpandco.com" target="_blank"> Visitez nous  </a> </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                           <!--             <p></p>
                                        <p></p>  -->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>
                <!-- END CENTERED WHITE CONTAINER -->

                <!-- START FOOTER -->
                <div class="footer">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-block">
                                <span class="apple-link">TCORP & CO, situ&eacute; &agrave; angr&eacute; 8-&egrave;me tranche, Djibi 1 non loin du carrefour Mandela <br>
                                    RC N CI-ABJ-2018-A 32195 - CCN 1293101 T <br>
                                    Tel: +225 22 59 23 20 / 22 50 26 64 - Email: services@tcorpandco.com
                                </span>
                                <br>  <a href=""></a>.
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block powered-by">
                              <!--  Powered by <a href="http://www.tcorpandco.com">TCORPANDCO</a>. -->
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- END FOOTER -->

            </div>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html> ';

	   $date = date('Y-m-d');

	      $formation['req'] ="INSERT INTO formation (contenu_formation,nom_prenoms,telephone,email,niveau,objectif,disponibilite,habitation,date_inscription)
                                            VALUES (:contenu_formation,:nom_prenoms,:telephone,:email,:niveau,:objectif,:disponibilite,:habitation,:date_inscription)";


          $formation['r'] = $formation['dataBase']->prepare($formation['req']);

          $formation['r']->execute(array(

              "contenu_formation" =>$formation['contenu_formation'],
              "nom_prenoms"=>$formation['nom_prenoms'],
              "telephone"=>$formation['telephone'],
              "email"=>$formation['email'],
              "niveau"=>$formation['niveau'],
              "objectif"=>$formation['objectif'],
              "disponibilite"=>$formation['disponibilite'],
              "habitation"=>$formation['habitation'],
			  "date_inscription"=>$date 

          ));




     }

 //  utilitaires::MailingPdf($formation['nom_prenoms'] ,$formation['email'],'','', '','services@tcorpandco.com', 'TCORPANDCO','services@tcorpandco.com','FORMATIONS DIGITALES',$email);

     echo json_encode($formation);