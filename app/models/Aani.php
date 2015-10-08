<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Aani extends BaseModel {
    public $id;
    public $aanestajaid;
    public $ehdokasid;

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
                'aanestajaid' => $row['aanestajaid'],
                'ehdokasid' => $row['ehdokasid']
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
                'aanestajaid' => $row['aanestajaid'],
                'ehdokasid' => $row['ehdokasid']
            ));
        }
        return $aanet;
    }
    
}