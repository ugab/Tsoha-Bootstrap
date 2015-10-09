<?php

class Aanestys extends BaseModel{
    
  public $id, $nimi, $aanestysalkaa, $aanestysloppuu, $kuvaus, $onkoid, $luojaid;
  
  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_kuvaus', 'validate_nimi');
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
  
    public static function find_all($id){
    
    $query = DB::connection()->prepare('SELECT * FROM Aanestys WHERE luojaid=:id');
    // Suoritetaan kysely
    $query->execute(array('id' => $id));
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
      $aanestys = new Aanestys(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'aanestysalkaa' => $row['aanestysalkaa'],
        'aanestysloppuu' => $row['aanestysloppuu'],
        'kuvaus' => $row['kuvaus'],
        'onkoid' => $row['onkoid'],
        'luojaid' => $row['luojaid']
      ));

      return $aanestys;
    }

    return null;
  }

  
  
//  INSERT INTO Customers (CustomerName, ContactName, Address, City, PostalCode, Country)
//VALUES (nimi, aanestysalkaa, aanestysloppuu, kuvaus, onkoid, luojaid); 

    public function save(){
    $query = DB::connection()->prepare('INSERT INTO Aanestys (nimi, aanestysalkaa, aanestysloppuu, kuvaus, onkoid, luojaid) VALUES (:nimi, :aanestysalkaa, :aanestysloppuu, :kuvaus, :onkoid, :luojaid) RETURNING id');
    $query->execute(array('nimi' => $this->nimi, 'aanestysalkaa' => $this->aanestysalkaa, 'aanestysloppuu' => $this->aanestysloppuu, 'kuvaus' => $this->kuvaus, 'onkoid' => $this->onkoid, 'luojaid' => $this->luojaid));
    $row = $query->fetch();
    $this->id = $row['id'];
    Kint::trace();
    Kint::dump($row);

  }  

    public function update($id){
    $query = DB::connection()->prepare('UPDATE Aanestys SET (nimi, aanestysalkaa, aanestysloppuu, kuvaus, onkoid, luojaid) = (:nimi, :aanestysalkaa, :aanestysloppuu, :kuvaus, :onkoid, :luojaid) WHERE id=:id');
    $query->execute(array('id' => $id, 'nimi' => $this->nimi, 'aanestysalkaa' => $this->aanestysalkaa, 'aanestysloppuu' => $this->aanestysloppuu, 'kuvaus' => $this->kuvaus, 'onkoid' => $this->onkoid, 'luojaid' => $this->luojaid));
    $row = $query->fetch();
    $this->id = $id;

  }  

  
    public function destroy($id){
        $query = DB::connection()->prepare('DELETE FROM Ehdokas where aanestysid = :id');
        $query->execute(array('id' => $this->id));
        
        $query = DB::connection()->prepare('DELETE FROM Aanestys where id = :id');
        $query->execute(array('id' => $this->id));
        
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