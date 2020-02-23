<?php

class DegreesModel
{
    protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }

    public function getDegrees(){

        $consulta = $this->db->prepare('SELECT codiEstudis,nomGrau FROM estudisuab');
        $consulta->execute();
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }
    public function getDegreesByCountry($idCountry){

        $consulta = $this->db->prepare('SELECT es.nomGrau,es.codiEstudis
                                        FROM universitats un,universitat_estudisuab ue,estudisuab es                     
                                        WHERE ue.idUniversitat = un.idUniversitat
                                        AND un.idPais = ?
                                        AND es.codiEstudis = ue.codiEstudis
                                        GROUP BY es.codiEstudis');
        $consulta->execute(array($idCountry));
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }
    public function getDegreeByName($nameDegree){

        $consulta = $this->db->prepare('SELECT codiEstudis FROM estudisuab WHERE nomGrau= ?');
        $consulta->execute(array($nameDegree));
        $obj = $consulta->fetchAll();
        //devolvemos la colección para que la vista la presente.
        return $obj[0]['codiEstudis'];
    }
    public function disconnect(){
        $this->db =null;
    }

   
}
?>