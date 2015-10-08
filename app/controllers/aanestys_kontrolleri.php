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
    
    $kayttaja=self::get_user_logged_in();
    
    if(($kayttaja->id)==$aanestys->luojaid){
        View::make('aanestys/omaaanestys.html', array('ehdokkaat' => $ehdokkaat, 'aanestys' => $aanestys));
    }else{
        View::make('aanestys/aanestys.html', array('ehdokkaat' => $ehdokkaat, 'aanestys' => $aanestys));
    }
    
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
    View::make('aanestys/muokkaa.html', array('aanestys' => $aanestys));
  }

  // Pelin muokkaaminen (lomakkeen käsittely)
  public static function update($id){
    $params = $_POST;

    $attributes = array(
        'nimi' => $params['nimi'],
        'aanestysalkaa' => $params['aanestysalkaa'],
        'aanestysloppuu' => $params['aanestysloppuu'],
        'kuvaus' => $params['kuvaus'],
        'onkoid' => $params['onkoid'],
        'luojaid' => '1'
    );

    // Alustetaan Game-olio käyttäjän syöttämillä tiedoilla
    $aanestys = new Aanestys($attributes);
    $errors = $aanestys->errors();

    if(count($errors) > 0){
      View::make('aanestys/muokkaa.html', array('errors' => $errors, 'aanestys' => $attributes));
    }else{
      // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
      $aanestys->update($id);

      Redirect::to('/' . $aanestys->id, array('message' => 'Peliä on muokattu onnistuneesti!'));
    }
  }

  // Pelin poistaminen
  public static function destroy($id){
    // Alustetaan Game-olio annetulla id:llä
    $aanestys = new Aanestys(array('id' => $id));
    // Kutsutaan Game-malliluokan metodia destroy, joka poistaa pelin sen id:llä
    $aanestys->destroy($id);

    // Ohjatan käyttäjä pelien listaussivulle ilmoituksen kera
    Redirect::to('/', array('message' => 'Peli on poistettu onnistuneesti!'));
  }    
  
}