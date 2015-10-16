<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Aanestaneet extends BaseModel {
    public $id;
    public $aanestajaid;
    public $aanestysid;

    public function __construct($attributes) {
        parent::__construct($attributes);
        /*$this->validators = array('validate_password', 'validate_ user');*/
    }

//    
//    public static function all() {
//        $query = DB::connection()->prepare('SELECT * FROM Aani');
//        $query->execute();
//        $rows = $query->fetchAll();
//        $aanet = array();
//        foreach ($rows as $row) {
//            $aanet[] = new Aani(array(
//                'id' => $row['id'],
////                'aanestajaid' => $row['aanestajaid'],
//                'aanestysid' => $row['aanestysid']
//            ));
//        }
//        return $aanet;
//    }


    public static function tarkista($aanestysid, $aanestajaid) {
        $query = DB::connection()->prepare('SELECT * FROM Aanestaneet WHERE aanestajaid = :aanestajaid AND aanestysid = :aanestysid LIMIT 1');
        $query->execute(array('aanestajaid' => $aanestajaid, 'aanestysid' => $aanestysid));
        $row = $query->fetch();
        if (!$row) {
            return 1;//ei ole äänestämneet
        }
        return 0;//on aanestanyt
    }

    
    public function save(){
        
//        $kayttaja=self::get_user_logged_in();
        
//        if(!$id){
//            $query = DB::connection()->prepare('INSERT INTO Aani (aanestajaid, ehdokasid) VALUES (:aanestajaid, :ehdokasid) RETURNING id');
//            $query->execute(array('aanestajaid' => NULL, 'ehdokasid' => $this->ehdokasid));
//        }else{
            $query = DB::connection()->prepare('INSERT INTO Aanestaneet (aanestysid, aanestajaid) VALUES (:aanestysid, :aanestajaid) RETURNING id');
            $query->execute(array('aanestysid' => $this->aanestysid, 'aanestajaid' => $this->aanestajaid));
//        }
        
//            $aanet = new Aani(array(
//                'id' => $row['id'],
//                'aanestajaid' => $row['aanestajaid'],
//                'aanestysid' => $row['$aanestysid']
//            ));
  }      
}