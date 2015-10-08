<?php

class KayttajaController extends BaseController{
  public static function kirjaudu(){
      View::make('kayttaja/kirjautuminen.html');
  }
  
  public static function kasittele_kirjautuminen(){
    $params = $_POST;

    $kayttaja = User::authenticate($params['nimi'], $params['salasana']);

    if(!$kayttaja){
      View::make('kayttaja/kirjautuminen.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'nimi' => $params['nimi']));
    }else{
      $_SESSION['kayttaja'] = $kayttaja->id;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
    }
  }
}