<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Kayttaja extends BaseModel {
    public $id;
    public $nimi;
    public $salasana;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_salasana', 'validate_nimi');
    }
/*
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Dude');
        $query->execute();
        $rows = $query->fetchAll();
        $users = array();
        foreach ($rows as $row) {
            $users[] = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
        }
        return $users;
    }
*/
    public static function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            $kayttaja = new Kayttaja(array( 
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
            return $kayttaja;
        } else {
            return null;
        }
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
        }
        return $kayttaja;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Kayttaja (nimi, salasana) VALUES (:nimi, :salasana) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'salasana' => $this->salasana));
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
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $this->nimi));
        $row = $query->fetch();
        if ($row){
            $errors[] = 'Nimi on jo käytössä';
        }
        
        return $errors;        
    }  
    
    public function validate_salasana(){
        $errors = array();
        if ($this->salasana == '' || $this->salasana == null) {
            $errors[] = 'Salasanaa ei annettu';
        }
        if (strlen($this->salasana) < 3) {
            $errors[] = 'Salasanaa pituus liian lyhyt';
        }
        if (strlen($this->salasana) > 50) {
            $errors[] = 'Salasanaa pituus liian pitkä';
        }
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE salasana = :salasana LIMIT 1');
        $query->execute(array('salasana' => $this->salasana));
        $row = $query->fetch();
        if ($row){
            $errors[] = 'Salasana on jo käytössä';
        }
        
        return $errors;     
    }
}