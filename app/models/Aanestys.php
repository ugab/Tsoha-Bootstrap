<?php

class Aanestys extends BaseModel{
    
  public $id, $nimi, $aanestysalkaa, $aanestysloppuu, $kuvaus, $onkoid, $luojaid;
  
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  
    public static function all(){
    // Alustetaan kysely tietokantayhteydellämme
    $query = DB::connection()->prepare('SELECT * FROM Aanestys');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $Aanestykset = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $Aanestykset[] = new Aanestys(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'aanestysalkaa' => $row['aanestysalkaa'],
        'aanestysloppuu' => $row['aanestysloppuu'],
        'kuvaus' => $row['kuvaus'],
        'onkoid' => $row['onkoid'],
        'luojaid' => $row['luojaid']
      ));
    }

    return $Aanestykset;
  }
  
  
  
    public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Aanestys WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $game = new Aanestys(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'aanestysalkaa' => $row['aanestysalkaa'],
        'aanestysalppuu' => $row['aanestysalppuu'],
        'kuvaus' => $row['kuvaus'],
        'onkoid' => $row['onkoid'],
        'luojaid' => $row['luojaid']
      ));

      return $game;
    }

    return null;
  }
  
  
}