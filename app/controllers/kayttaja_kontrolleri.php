<?php

class KayttajaController extends BaseController{
  public static function kirjaudu(){
      View::make('kayttaja/kirjautuminen.html');
  }
  
  public static function kasittele_kirjautuminen(){
    $params = $_POST;

    $kayttaja = Kayttaja::authenticate($params['nimi'], $params['salasana']);

    if(!$kayttaja){
      View::make('kayttaja/kirjautuminen.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'nimi' => $params['nimi']));
    }else{
      $_SESSION['kayttaja'] = $kayttaja->id;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
    }
  }
  
  public static function uloskirjautuminen(){
    $_SESSION['kayttaja'] = null;
    Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
  }
  
  public static function rekisteroidy(){
    View::make('kayttaja/rekisteroidy.html');
  }
//  array('message' => 'Peli on lisätty kirjastoosi!'))
  
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;

      $attributes = (array(
//        'id' => $params['id'],
        'nimi' => $params['nimi'],
        'salasana' => $params['salasana']
      ));
      
    $kayttaja = new Kayttaja($attributes);
    $errors = $kayttaja->errors();
    
    if(count($errors) == 0){
      $kayttaja->save();
      Redirect::to('/');
    }else{
      
      View::make('kayttaja/rekisteroidy.html', array('errors' => $errors, 'attributes' => $attributes));
    }

  }  
}