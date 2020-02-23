<?php

class ProgramsModel
{
    protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }

    public function getPrograms(){

        $consulta = $this->db->prepare('SELECT * FROM tipusprogramamobilitat');
        $consulta->execute();
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }
    public function insertNewProgram($codiPrograma,$nom,$descripcio){
        try{
            $consulta = $this->db->prepare("INSERT INTO tipusprogramamobilitat (codiPrograma, nom, descripció) VALUES (?, ?, ?)");
            $consulta->execute(array($codiPrograma,$nom,$descripcio));
        }catch (Exception $e) {
            die($e->getMessage());
        }

    }
    public function updateInfoByCode($codiPrograma,$nom,$descripcio){
        try {
            $consulta = $this->db->prepare('UPDATE tipusprogramamobilitat SET codiPrograma=?,nom=?,descripció=? WHERE codiPrograma=?');
            $consulta->execute(array($codiPrograma,$nom,$descripcio,$codiPrograma));
        } catch (Exception $e) {
            die($e->getMessage()); 
        }

    }
    public function deleteProgramByCode($codiPrograma){
        try {
            $consulta = $this->db->prepare("DELETE FROM tipusprogramamobilitat WHERE codiPrograma=?");
            $consulta->execute(array($codiPrograma));   
        } catch (Exception $e) {
            die($e->getMessage()); 
        }
    }
    public function disconnect(){
        $this->db =null;
    }


   
}
?>