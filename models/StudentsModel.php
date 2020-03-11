<?php

class StudentsModel{

	protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }
 
    public function getAllStudents(){
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM estudiant ORDER BY nom ASC');
        $consulta->execute();
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }

    public function getStudentByName($name){
        try{

            $nom = explode(" ", $name);
            $studentName = $nom[0];
            $studentSurename = $nom[1];
            $consulta = $this->db->prepare('SELECT niuEstudiant
                                            FROM estudiant
                                            WHERE 
                                            cognom =? AND
                                            nom =?');
            $consulta->execute(array($studentSurename, $studentName));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getUser($niu)
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM estudiant WHERE niuEstudiant = ?');
        $consulta->execute(array($niu));
        $obj = $consulta->fetch(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }
    public function updateInfoByNiu($niu,$nom,$cognom,$mail,$nompublic,$correupublic){
        $consulta = $this->db->prepare('
        UPDATE estudiant 
        SET nom=?,cognom=?,correu=?,publicNom=?,publicMail=? 
        WHERE niuEstudiant=?');
        $consulta->execute(array($nom,$cognom,$mail,$nompublic,$correupublic,$niu));
    }
    public function insertNewUser($niu,$nom,$cognom,$mail,$nomPublic,$correuPublic){

        try{
            $consulta = $this->db->prepare("INSERT INTO estudiant (niuEstudiant, nom, cognom, correu, publicNom, publicMail) VALUES (?, ?, ?, ?, ?, ?)");
            $consulta->execute(array($niu,$nom,$cognom,$mail,$nomPublic,$correuPublic));
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function insertPhotoOnUser($niu,$photo){
        try{
            $consulta = $this->db->prepare('UPDATE estudiant SET foto=? WHERE niuEstudiant=?');
            $consulta->execute(array($photo,$niu));
        }catch (Exception $e) {
            die($e->getMessage());
        }
        

    }
    public function deleteStudent($niu){
        try {
            $consulta = $this->db->prepare("DELETE FROM estudiant WHERE niuEstudiant=?");
            $consulta->execute(array($niu));   
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function disconnect(){
        $this->db =null;
    }


}

?>