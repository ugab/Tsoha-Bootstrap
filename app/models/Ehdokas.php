<?php

class Ehdokas extends BaseModel{
    
  public $id, $nimi, $kuvaus, $aanestysid, $aania;
  
  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_nimi', 'validate_kuvaus');
  }
  
    public static function all($id){
    // Alustetaan kysely tietokantayhteydellämme
//    $kalle = aanestys::id;    
        
    $query = DB::connection()->prepare('SELECT * FROM Ehdokas WHERE aanestysid=:id');
    // Suoritetaan kysely
    $query->execute(array('id' => $id));
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $ehdokkaat = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $ehdokkaat[] = new Ehdokas(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'kuvaus' => $row['kuvaus'],
        'aanestysid' => $row['aanestysid'],
        $haku = 'SELECT COUNT(*) AS aania FROM Aanet WHERE ehdokasid=:ehdokasid',
        $query = DB::connection()->prepare($haku),
        $query->execute(array('ehdokasid' => $row['id'])),
        $aanet = $query->fetch(),
        'aania' => $aanet['aania']  
      ));
    }

    return $ehdokkaat;
  }
    
  
    public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Ehdokas WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $ehdokas[] = new Ehdokas(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'kuvaus' => $row['kuvaus'],
        'aanestysid' => $row['aanestysid']
      ));

      return $ehdokas;
    }

    return null;
  }
//  INSERT INTO Customers (CustomerName, ContactName, Address, City, PostalCode, Country)
//VALUES (nimi, aanestysalkaa, aanestysloppuu, kuvaus, onkoid, luojaid); 

    public function save(){
    $query = DB::connection()->prepare('INSERT INTO Ehdokas (nimi, kuvaus, aanestysid) VALUES (:nimi, :kuvaus, :aanestysid) RETURNING id');
    $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'aanestysid' => $this->aanestysid));
    $row = $query->fetch();

  }  

    public function validate_nimi(){
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimeä ei annettu';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'Nimen pituus liian lyhyt';
        }
        if (strlen($this->nimi) > 50) {
            $errors[] = 'Nimen pituus liian pitkä';
        }
        return $errors;        
    }  
    
    public function validate_kuvaus(){

        $errors = array();
        if (strlen($this->kuvaus) > 400) {
            $errors[] = 'kuvaus pituus liian pitkä';
        }
        return $errors;        
    }      
}