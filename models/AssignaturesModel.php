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
            $consulta = $this->db->prepare('SELECT ass.nomAssignatura,ass.codiAssignaturaUAB,es.nomGrau FROM assignaturesuab ass, estudisuab es
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

    public function disconnect(){
        $this->db =null;
    }


}

?>