<?php

class AanestysController extends BaseController{
    
  public static function lista(){
      
    $aanestykset = Aanestys::all();
    
    View::make('aanestys/lista.html', array('aanestykset' => $aanestykset));
  }

  
  public static function nayta($id){
      
//    $aanestys = Aanestys::find($id);
    $ehdokkaat = Ehdokas::all($id);
    
    View::make('aanestys/aanestys.html', array('ehdokkaat' => $ehdokkaat));
  }
  
  public static function uusi(){
      
//    $aanestys = Aanestys::find($id);
//    $ehdokkaat = Ehdokas::all($id);
    
    View::make('aanestys/uusi.html');
  }  

  
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;

      $aanestys = new Aanestys(array(
//        'id' => $params['id'],
        'nimi' => $params['nimi'],
        'aanestysalkaa' => $params['aanestysalkaa'],
        'aanestysloppuu' => $params['aanestysloppuu'],
        'kuvaus' => $params['kuvaus'],
        'onkoid' => $params['onkoid'],
        'luojaid' => '1'
      ));
  Kint::dump($params);

    $aanestys->save();  
  }  
  
}
