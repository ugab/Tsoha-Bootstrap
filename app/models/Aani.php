<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Aani extends BaseModel {
    public $id;
    public $aanestajaid;
    public $aanestysid;

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
            $aanet[] = new User(array(
                'id' => $row['id'],
                'aanestajaid' => $row['aanestajaid'],
                'aanestysid' => $row['aanestysid']
            ));
        }
        return $aanet;
    }


    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Aani WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $aanet = new Kayttaja(array(
                'id' => $row['id'],
                'aanestajaid' => $row['aanestajaid'],
                'aanestysid' => $row['aanestysid']
            ));
        }
        return $aanet;
    }
    
}