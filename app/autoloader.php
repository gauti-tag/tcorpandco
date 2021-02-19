<?php

class Autoloader
{


    /**
     * @param $class
     */

    static  function register(){

     spl_autoload_register(array('Autoloader','autoload'));

    }


    /**
     * @param $class
     */
     static function autoload($file){

                 require '../'.$file. '.html';

         }

        

     

}