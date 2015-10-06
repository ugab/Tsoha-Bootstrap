<?php

require 'app/models/Aanestys.php';

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/lista.html');
    }

    public static function sandbox(){
        
    $doom = new Aanestys(array(
        'nimi' => 'a',
        'aanestysalkaa' => '20.04.2010',
        'aanestysloppuu' => '20.04.2011',
        'kuvaus' => 'kuvaus',
        'onkoid' => 'onkoid',
        'luojaid' => 'luojaid'
        ));
        $errors = $doom->errors();

        Kint::dump($errors);
    }
    
    public static function lista(){
      View::make('suunnitelmat/lista.html');
    }
    
    public static function listaa_aanestykset(){
        $aanestykset = Aanestys::all();        
    }

    public static function muokkaa(){
      View::make('suunnitelmat/muokkaa.html');
    }

    public static function uusi(){
      View::make('suunnitelmat/uusi.html');
    }    
    
    public static function aanestys(){
      View::make('suunnitelmat/aanestys.html');
    }        
  }
