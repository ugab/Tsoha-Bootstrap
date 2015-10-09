<?php

class AaniController extends BaseController{
    
  public static function aani(){
    
    $params = $_POST;
      
    $kayttaja=self::get_user_logged_in();  
//    $id=1;
      
    $aanestysid=$params['aanestysid'];
    
    
    if($kayttaja){
        $attributes = (array(
           'aanestajaid' => $id,
           'ehdokasid' => $params['ehdokasid']
        ));
    }else if(isset($_COOKIE[$aanestysid])){
        
        Redirect::to('/' . $params['aanestysid'], array('message' => 'Olet jo äänestänyt'));
    }else if($params['onkoid']!=1){
        $attributes = (array(
           'aanestajaid' => NULL,
           'ehdokasid' => $params['ehdokasid']
        ));
//        $aanestysid=$params['aanestysid'];
//        $_SESSION[$aanestysid] = $kayttaja->id;
        setcookie($aanestysid);
    }else{
        Redirect::to('/' . $params['aanestysid'], array('message' => 'Kirjaudu niin voit äänestää'));
    }

    $aani = new Aani($attributes);
 
//    $aanestys = Aanestys::find($id);    
    
    $aani->save();
    Redirect::to('/' . $params['aanestysid'], array('message' => 'Olet äänestänyt'));


  }        
      
}