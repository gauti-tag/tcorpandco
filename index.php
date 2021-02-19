<?php

/*require ('app/autoloader.php');

    Autoloader::register();


    if (isset($_GET['p'])){
        
        $p = $_GET['p'];
        
    }else{
        
        $p = 'logiciel';
    }



 if($p === 'logiciel'){

         require 'home.html';


    }elseif ($p === 'galerie'){

        require 'galerie.html';


        
    }elseif ($p === 'votreManif'){

        require 'votreManif.html';
        
    }elseif ($p === 'contact'){

        require 'contact.html';


    }elseif ($p === 'admin'){

        require 'BackEnd/viewer.php';

    }*/


            $site =' ';

    if(isset($_GET['site'])) {


        $site = explode('/',$_GET['site']);

              if($site[1] ==='home'){

                  require 'home.html';
		  
        }elseif($site[2] === 'votremanif'){

			require 'votreManif.html';
	  
	      }

    }
