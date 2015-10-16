<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Aani extends BaseModel {
    public $id;
    public $aanestetty;
    public $ehdokasid;
    public $ehdokasnimi;

    public function __construct($attributes) {
        parent::__construct($attributes);
        /*$this->validators = array('validate_password', 'validate_ user');*/
    }

    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Aani');
        $query->execute();
        $rows = $query->fetchAll();
        $aanet = array();
        foreach ($rows as $row) {
            $aanet[] = new Aani(array(
                'id' => $row['id'],
                'aanestetty' => $row['aanestetty'],
                'ehdokasid' => $row['ehdokasid'],
                'ehdokasnimi' => $row['ehdokasnimi']
            ));
        }
        return $aanet;
    }


    public static function find($ehdokasid) {
        $query = DB::connection()->prepare('SELECT * FROM Aani WHERE id = :ehdokasid');
        $query->execute(array('ehdokasid' => $ehdokasid));
        $row = $query->fetch();
        if ($row) {
            $aanet = new Aani(array(
                'id' => $row['id'],
                'aanestetty' => $row['aanestetty'],
                'ehdokasid' => $row['ehdokasid'],
                'ehdokasnimi' => $row['ehdokasnimi']
            ));
        }
        return $aanet;
    }

    
    public function save(){
        
//        $kayttaja=self::get_user_logged_in();
        
//        if(!$id){
//            $query = DB::connection()->prepare('INSERT INTO Aani (aanestajaid, ehdokasid) VALUES (:aanestajaid, :ehdokasid) RETURNING id');
//            $query->execute(array('aanestajaid' => NULL, 'ehdokasid' => $this->ehdokasid));
//        }else{
        $this->aanestetty=date('Y/m/d H:i:s');
        $query = DB::connection()->prepare('INSERT INTO Aanet (ehdokasnimi, ehdokasid, aanestetty) VALUES (:ehdokasnimi, :ehdokasid, :aanestetty) RETURNING id');
        $query->execute(array('ehdokasid' => $this->ehdokasid, 'ehdokasnimi' => $this->ehdokasnimi, 'aanestetty' => $this->aanestetty));
//        }
        

  }      
}