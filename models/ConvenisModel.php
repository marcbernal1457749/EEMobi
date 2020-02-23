<?php

class ConvenisModel{

	protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }
    public function getConvenis(){
        try {
            $consulta = $this->db->prepare('SELECT uni.nomUniversitat, uni.idUniversitat, es.nomGrau,co.codiConveni,co.codiCentreEstudis,ce.plaçes,ce.mesos,ce.període
                                            FROM centreestudis ce, universitat_estudisuab un,universitats uni,estudisuab es,conveni co
                                            WHERE ce.codiUniEstudis = un.codiUniEstudis
                                            AND uni.idUniversitat = un.idUniversitat
                                            AND un.codiEstudis = es.codiEstudis
                                            AND co.codiCentreEstudis = ce.codiCentreEstudis
                                            ORDER BY uni.nomUniversitat');
            $consulta->execute();
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
 
        } catch (Exception $e) {
            
        }
        return $obj;   
    }

    public function getConvenisByIdUniversity($idUni){
        try {
            $consulta = $this->db->prepare('SELECT ce.codiCentreEstudis, ce.actiu, ce.plaçes, ce.mesos, ce.període, co.codiConveni, es.nomGrau, es.codiEstudis, pr.nom, pr.cognoms, pr.niuProfessor  
                                            FROM centreestudis ce, universitat_estudisuab un,universitats uni,estudisuab es,conveni co, professorscentre pc, professors pr
                                            WHERE ce.codiUniEstudis = un.codiUniEstudis
                                            AND uni.idUniversitat = un.idUniversitat
                                            AND un.codiEstudis = es.codiEstudis
                                            AND co.codiCentreEstudis = ce.codiCentreEstudis
                                            AND ce.codiCentreEstudis = pc.codiCentreEstudis
                                            AND pc.niuProfessor = pr.niuProfessor
                                            AND uni.idUniversitat =?');
            $consulta->execute(array($idUni));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {

        }
        return $obj;
    }

    public function addConveni($codiConveni,$codiCentreEstudis){
        //realizamos la consulta de todos los items
        try {
            $consulta = $this->db->prepare('INSERT INTO conveni(codiConveni,codiCentreEstudis) VALUES (?,?)');
            $consulta->execute(array($codiConveni,$codiCentreEstudis));   
        } catch (Exception $e) {
            
        }

    }
    public function updateConveni($codiConveni,$idConveni){
        //realizamos la consulta de todos los items
        try {
            $consulta = $this->db->prepare('UPDATE conveni SET codiConveni=? WHERE codiConveni=?');
            $consulta->execute(array($codiConveni,$idConveni));   
        } catch (Exception $e) {
            
        }

    }
    public function deleteConveni($idConveni){
        try {
            $consulta = $this->db->prepare('DELETE FROM conveni WHERE codiConveni=?');
            $consulta->execute(array($idConveni));
            
        } catch (Exception $e) {
            
        }
    }
    public function disconnect(){
        $this->db =null;
    }


}

?>