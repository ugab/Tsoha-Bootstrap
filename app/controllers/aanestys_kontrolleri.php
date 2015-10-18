<?php

class AanestysController extends BaseController{
    
  public static function lista(){
      
    $aanestykset = Aanestys::all();
    
    View::make('aanestys/lista.html', array('aanestykset' => $aanestykset));
  }

  public static function omalista(){
    $kayttaja=self::get_user_logged_in();  
    $aanestykset = Aanestys::find_all($kayttaja->id);
    
    View::make('aanestys/omalista.html', array('aanestykset' => $aanestykset));
  }
  
  public static function nayta($id){
      
    $aanestys = Aanestys::find($id);
    $ehdokkaat = Ehdokas::all($id);
    
    View::make('aanestys/aanestys.html', array('ehdokkaat' => $ehdokkaat, 'aanestys' => $aanestys));
    
//    $kayttaja=self::get_user_logged_in();
//                                                                          HUONO IDEA
//    if(!$kayttaja){
//        View::make('aanestys/aanestys.html', array('ehdokkaat' => $ehdokkaat, 'aanestys' => $aanestys));
//    }else if(($kayttaja->id)==$aanestys->luojaid){
//        View::make('aanestys/omaaanestys.html', array('ehdokkaat' => $ehdokkaat, 'aanestys' => $aanestys));
//    }else{
//        View::make('aanestys/aanestys.html', array('ehdokkaat' => $ehdokkaat, 'aanestys' => $aanestys));
//    }
    
  }
  
  public static function naytaomaaanestys($id){
      
    $aanestys = Aanestys::find($id);
    $ehdokkaat = Ehdokas::all($id);
    $aanet = Aani::all($id);
    
    View::make('aanestys/omaaanestys.html', array('ehdokkaat' => $ehdokkaat, 'aanestys' => $aanestys, 'aanet' => $aanet));
  }  
  
  public static function uusi(){
      
//    $aanestys = Aanestys::find($id);
//    $ehdokkaat = Ehdokas::all($id);
    
    View::make('aanestys/uusi.html');
  }  

  
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    $kayttaja=self::get_user_logged_in();
    
      $attributes = (array(
//        'id' => $params['id'],
        'nimi' => $params['nimi'],
        'aanestysalkaa' => $params['aanestysalkaa'],
        'aanestysloppuu' => $params['aanestysloppuu'],
        'kuvaus' => $params['kuvaus'],
        'onkoid' => $params['onkoid'],
        'luojaid' => $kayttaja->id
      ));

      

    $aanestys = new Aanestys($attributes);
    $errors = $aanestys->errors();

    if(count($errors) == 0){
      // Peli on validi, hyvä homma!
      $aanestys->save();
//      $ehdokkaat = Ehdokas::all($aanestys->id); ei tarvii ???
      Redirect::to('/uusi/' . $aanestys->id .'/uusiehdokas');
    }else{
      // Pelissä oli jotain vikaa :(
      View::make('aanestys/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
    }

  }

  public static function edit($id){
    $aanestys = Aanestys::find($id);
    $ehdokkaat = Ehdokas::all($id);
    
    View::make('aanestys/muokkaa.html', array('ehdokkaat' => $ehdokkaat, 'aanestys' => $aanestys));
  }

  // Pelin muokkaaminen (lomakkeen käsittely)
  public static function update($id){
    $params = $_POST;
    $kayttaja=self::get_user_logged_in();

    $attributes = array(
        'id' => $params['id'],
        'nimi' => $params['nimi'],
        'aanestysalkaa' => $params['aanestysalkaa'],
        'aanestysloppuu' => $params['aanestysloppuu'],
        'kuvaus' => $params['kuvaus'],
        'onkoid' => $params['onkoid'],
        'luojaid' => $kayttaja->id
    );

    // Alustetaan Game-olio käyttäjän syöttämillä tiedoilla
    $aanestys = new Aanestys($attributes);
    $errors = $aanestys->errors();

    if(count($errors) > 0){
      Redirect::to('/aanestys/' . $id . '/muokkaa', array('errors' => $errors, 'aanestys' => $attributes));
    }else{
      // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
      $aanestys->update($id);

      Redirect::to('/' . $id, array('message' => 'Aanestystä on muokattu onnistuneesti!'));
    }
  }

  // poistaminen
  public static function destroy($id){

    $ehdokkaat = Ehdokas::all($id);
    foreach($ehdokkaat as $ehdokas){
        

        $ehdokas->destroy($ehdokas->id);
        
    }
  
    $aanestys = new Aanestys(array('id' => $id));

    $aanestys->destroy($id);

    Redirect::to('/', array('message' => 'Aanestys on poistettu onnistuneesti!'));
  }   
  
}