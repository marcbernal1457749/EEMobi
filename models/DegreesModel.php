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

    public function addDegree($nom,$cicle,$descripcio){
        try {
            $consulta = $this->db->prepare("INSERT INTO estudisuab(codiFacultat,nomGrau,cicle,descripcio) VALUES (?,?,?,?)");
            $consulta->execute(array(115,$nom,$cicle,$descripcio));

        } catch (Exception $e) {
            $obj = $e;
        }

    }

    public function deleteDegree($idDegree){
        $consulta = $this->db->prepare('DELETE FROM estudisuab WHERE codiEstudis =?');
        $consulta->execute(array($idDegree));
    }

    public function editDegree($id, $nom){
        $consulta = $this->db->prepare('UPDATE estudisuab SET nomGrau =? WHERE codiEstudis =?');
        $consulta->execute(array($nom,$id));
    }

    public function disconnect(){
        $this->db =null;
    }

   
}
?>