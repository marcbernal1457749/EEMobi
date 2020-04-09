<?php

class AssignaturesModel{

	protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }
    public function getAllSubjects(){
        try {
            $consulta = $this->db->prepare('SELECT ass.nomAssignatura,ass.codiAssignaturaUAB,es.nomGrau,ass.url,ass.crèdits FROM assignaturesuab ass, estudisuab es
                WHERE ass.codiEstudis = es.codiEstudis
                ORDER BY ass.nomAssignatura');
            $consulta->execute();
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
 
        } catch (Exception $e) {
            
        }
        return $obj;   
    }
    public function getSubjectByTeacher($niuProfessor){
        try {
            $consulta = $this->db->prepare('SELECT ass.codiAssignaturaUAB,ass.nomAssignatura
                                            FROM professors pr, assignaturesuab ass
                                            WHERE pr.codiEstudis = ass.codiEstudis
                                            AND pr.niuProfessor = ?
                                            ORDER BY ass.nomAssignatura');
            $consulta->execute(array($niuProfessor));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
 
        } catch (Exception $e) {
            
        }
        return $obj;   

    }

    public function getSubjectsByDegree($idDegree){
        try {
            $consulta = $this->db->prepare('SELECT ass.codiAssignaturaUAB,ass.nomAssignatura
                                            FROM estudisuab de, assignaturesuab ass
                                            WHERE de.codiEstudis = ass.codiEstudis
                                            AND de.codiEstudis = ?
                                            ORDER BY ass.nomAssignatura');
            $consulta->execute(array($idDegree));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {

        }
        return $obj;

    }

    public function getURLAssignatures(){
        try {
            $consulta = $this->db->prepare('SELECT url, codiAssignaturaUAB, nomAssignatura FROM assignaturesuab');
            $consulta->execute();
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {

        }
        return $obj;
    }

    public function getNullURLAssignatures(){
        try {
            $consulta = $this->db->prepare('SELECT url, codiAssignaturaUAB, nomAssignatura FROM assignaturesuab WHERE url=" "');
            $consulta->execute();
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {

        }
        return $obj;
    }


    public function addAssignaturesUAB($codi,$nom,$credits,$url,$codiEstudis){
        try {
            $consulta = $this->db->prepare("INSERT INTO assignaturesuab(codiAssignaturaUAB,nomAssignatura,crèdits,url,codiEstudis) VALUES (?,?,?,?,?)");
            $consulta->execute(array($codi,$nom,$credits,$url,$codiEstudis));

        } catch (Exception $e) {
            $obj = $e;
        }

    }

    public function deleteAssignaturesUAB($idAssignatura){
        $consulta = $this->db->prepare('DELETE FROM assignaturesuab WHERE codiAssignaturaUAB =?');
        $consulta->execute(array($idAssignatura));
    }

    public function editAssignaturesUAB($id, $nom,$url){
        $consulta = $this->db->prepare('UPDATE assignaturesuab SET nomAssignatura =?,url=?  WHERE codiAssignaturaUAB =?');
        $consulta->execute(array($nom,$url,$id));
    }

    public function disconnect(){
        $this->db =null;
    }


}

?>