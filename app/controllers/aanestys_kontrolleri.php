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
  
}
