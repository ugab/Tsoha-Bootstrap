<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
       View::make('helloworld.html');
    }
    
    public static function lista(){
      View::make('suunnitelmat/lista.html');
    }
    
    public static function listaa_aanestykset(){
        $aanestykset = aanestys::all();
        
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
