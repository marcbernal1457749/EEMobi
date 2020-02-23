<?php

class CentreEstudisModel{

	protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }
 
    public function addInfoUniPlaces($actiu,$plaçes,$mesos,$període,$codiUniEstudis){
        //realizamos la consulta de todos los items
        try {
            $consulta = $this->db->prepare('INSERT INTO centreestudis(actiu,plaçes,mesos,període,codiUniEstudis) VALUES (?,?,?,?,?)');
            $consulta->execute(array($actiu,$plaçes,$mesos,$període,$codiUniEstudis));
            $id = $this->db->lastInsertId();
            return $id;   
        } catch (Exception $e) {
            
        }

    }
    public function updateInfoUniPlaces($actiu,$plaçes,$mesos,$període,$codiCentreEstudis){
        //realizamos la consulta de todos los items
        try {
            $consulta = $this->db->prepare('UPDATE centreestudis SET actiu=?,plaçes=?,mesos=?,període=? WHERE codiCentreEstudis=?');
            $consulta->execute(array($actiu,$plaçes,$mesos,$període,$codiCentreEstudis));
        } catch (Exception $e) {
            
        }

    }
    public function deleteInfoUniPlaces($codiCentreEstudis){
        try {
            $consulta = $this->db->prepare('DELETE FROM centreestudis WHERE codiCentreEstudis=?');
            $consulta->execute(array($codiCentreEstudis));
            
        } catch (Exception $e) {
            
        }
    }
    public function disconnect(){
        $this->db =null;
    }


}

?>