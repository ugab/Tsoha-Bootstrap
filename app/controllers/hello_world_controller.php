<?php

require 'app/models/Aanestys.php';

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/lista.html');
    }

    public static function sandbox(){
        
        $skyrim = Aanestys::find(1);
        
        $aanestykset = Ehdokas::all(1);
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($aanestykset);
        Kint::dump($skyrim);
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
