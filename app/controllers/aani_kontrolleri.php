<?php

class AaniController extends BaseController{
    
  public static function aani(){
    
    $params = $_POST;
      
    $kayttaja=self::get_user_logged_in();  
      
    if($kayttaja){
        $attributes = (array(
           'aanestajaid' => $kayttaja->id,
           'ehdokasid' => $params['ehdokasid']
        ));
    }else if($params['onkoid']!=1){
        $attributes = (array(
           'aanestajaid' => NULL,
           'ehdokasid' => $params['ehdokasid']
        ));                   
    }else{
        Redirect::to('/' . $params['aanestysid'], array('message' => 'Kirjaudu niin voit äänestää'));
    }

    $aani = new Aani($attributes);
 
//    $aanestys = Aanestys::find($id);    
    
    $aani->save();
    Redirect::to('/' . $params['aanestysid'], array('message' => 'Olet äänestänyt'));


  }        
      
}