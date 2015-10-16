<?php

class AaniController extends BaseController{
    
  public static function aani(){
    
    $params = $_POST;

    if(strtotime($params['aanestysalkaa'])>strtotime('now') or strtotime($params['aanestysloppuu'])<strtotime('now')){
        Redirect::to('/' . $params['aanestysid'], array('message' => 'Et voi äänestää aikarajoitteiden takia'));
    }      
    
    $kayttaja=self::get_user_logged_in();  
      
    $aanestysid=$params['aanestysid'];    
    
    if($kayttaja){//KIRJAUDUTTU
        $tarkista=Aanestaneet::tarkista($aanestysid, $kayttaja->id);

        if($tarkista){   //ei ole aanestanyt
            $aani_attributes = (array(
               'ehdokasid' => $params['ehdokasid']
            ));
            $aanestaneet_attributes = (array(//lisataan etta on aanestanyt
               'aanestajaid' => $kayttaja->id,
               'aanestysid' => $params['aanestysid']
            ));
            $aanestaneet = new Aanestaneet($aanestaneet_attributes);
            $aanestaneet->save();
//            setcookie($aanestysid); PITÄÄ MIETTIÄ.....L.....KLGHUIKFCAPS LOCK EI SOVI TÄHÄN
        }else if($tarkista==0){//on aanestanyt
            Redirect::to('/' . $params['aanestysid'], array('message' => 'Olet jo äänestänyt'));
        }     
    }else{//ANONYYMI AANESTAJA
        if(isset($_COOKIE[$aanestysid])){//on aanestanyt
            Redirect::to('/' . $params['aanestysid'], array('message' => 'Olet jo äänestänyt'));
        }else if($params['onkoid']!=1){//ei id aanestys
            $aani_attributes = (array(
               'aanestajaid' => NULL,
               'ehdokasid' => $params['ehdokasid']
            ));
            setcookie($aanestysid);
        }else{
            Redirect::to('/' . $params['aanestysid'], array('message' => 'Kirjaudu niin voit äänestää'));
        }  
    }
    
//    $tarkista=Aanestaneet::tarkista($aanestysid, $kayttaja->id);
//    
//    if($kayttaja and $tarkista){   //id ja ei ole aanestanyt
//        $aani_attributes = (array(
//           'ehdokasid' => $params['ehdokasid']
//        ));
//        $aanestaneet_attributes = (array(//lisataan etta on aanestanyt
//           'aanestajaid' => $kayttaja->id,
//           'aanestysid' => $params['aanestysid']
//        ));
//    }else if(isset($_COOKIE[$aanestysid]) or $tarkista==0){//
//        Redirect::to('/' . $params['aanestysid'], array('message' => 'Olet jo äänestänyt'));
//    }else if($params['onkoid']!=1){
//        $aani_attributes = (array(
//           'aanestajaid' => NULL,
//           'ehdokasid' => $params['ehdokasid']
//        ));
//        setcookie($aanestysid);
//    }else{
//        Redirect::to('/' . $params['aanestysid'], array('message' => 'Kirjaudu niin voit äänestää'));
//    }
    $aani_attributes = (array('ehdokasnimi' => $params['ehdokasnimi']));
    
    $aani = new Aani($aani_attributes);
    
    $aani->save();
    

    Redirect::to('/' . $params['aanestysid'], array('message' => 'Olet äänestänyt'));


  }
  
}