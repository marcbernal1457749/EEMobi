<?php

class AcordEstudisModel{

	protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }
    public function getAcordsEstudis(){
        try{
            $consulta = $this->db->prepare('SELECT ac.codiAcord,ac.codiEstada,ac.codiAsignaturaDesti,ac.nomAsignaturaDesti,ac.creditsAsignaturaDesti,ass.nomAssignatura, es.niuEstudiant,ac.codiAssignaturaUAB,ac.linkAssignaturaDesti
                                            FROM assignaturesuab ass, acordestudis ac,estada es
                                            WHERE ass.codiAssignaturaUAB =  ac.codiAssignaturaUAB
                                            AND ac.codiEstada = es.codiEstada');
            $consulta->execute();
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }

    }
    public function getAcordByNiu($niu){
        try{
            $consulta = $this->db->prepare('SELECT * FROM estada es, acordestudis ac
                                            WHERE es.niuEstudiant = ?
                                            AND es.codiEstada =  ac.codiEstada');
            $consulta->execute(array($niu));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }

    }
    public function getAcordByStay($codiConveni){
        try{
            $consulta = $this->db->prepare('SELECT ac.codiAcord,ac.codiEstada,ac.codiAsignaturaDesti,ac.nomAsignaturaDesti,ac.creditsAsignaturaDesti,ass.nomAssignatura, ac.codiAssignaturaUAB, es.niuEstudiant,ac.codiAssignaturaUAB,ac.linkAssignaturaDesti
                                            FROM acordestudis ac, estada es, assignaturesuab ass, professorscentre prc
                                            WHERE ac.codiEstada = es.codiEstada
                                            AND es.codiEstada = ?
                                            AND ass.codiAssignaturaUAB = ac.codiAssignaturaUAB
                                            GROUP BY ac.codiAcord,ac.codiEstada,ac.codiAsignaturaDesti,ac.nomAsignaturaDesti,ac.creditsAsignaturaDesti,ass.nomAssignatura, es.niuEstudiant,ac.codiAssignaturaUAB,ac.linkAssignaturaDesti');
            $consulta->execute(array($codiConveni));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }

    }
    
    public function getAcordsByStay($codiConveni){
        try{
            $consulta = $this->db->prepare('SELECT es.niuEstudiant, ac.nomAsignaturaDesti, ass.nomAssignatura, ac.linkAssignaturaDesti
                                            FROM estada es, acordestudis ac, assignaturesuab ass, conveni co
                                            WHERE co.codiConveni = ?
                                            AND co.codiConveni = es.codiConveni
                                            AND es.codiEstada = ac.codiEstada
                                            AND ac.codiAssignaturaUAB = ass.codiAssignaturaUAB');
            $consulta->execute(array($codiConveni));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }

    }
    
    public function addAcord($codiEstada,$codiAssignaturaUAB,$codiAsignaturaDesti,$nomAsignaturaDesti,$creditsAsignaturaDesti,$enllaçAssignaturaDesti){
        //realizamos la consulta de todos los items
        try {
            $consulta = $this->db->prepare('INSERT INTO acordestudis(codiEstada,codiAssignaturaUAB,codiAsignaturaDesti,nomAsignaturaDesti,creditsAsignaturaDesti,linkAssignaturaDesti) VALUES (?,?,?,?,?,?)');
            $consulta->execute(array($codiEstada,$codiAssignaturaUAB,$codiAsignaturaDesti,$nomAsignaturaDesti,$creditsAsignaturaDesti,$enllaçAssignaturaDesti));

            $id = $this->db->lastInsertId();
            return $id;
        } catch (Exception $e) {
            
        }

    }
    public function updateAcord($codiEstada,$codiAssignaturaUAB,$codiAsignaturaDesti,$nomAsignaturaDesti,$creditsAsignaturaDesti,$idAcord,$enllaçAssignaturaDesti){
        //realizamos la consulta de todos los items
        try {
            $consulta = $this->db->prepare('UPDATE acordestudis SET codiEstada=?,codiAssignaturaUAB=?,
              codiAsignaturaDesti=?,nomAsignaturaDesti=?,creditsAsignaturaDesti=?,linkAssignaturaDesti=? WHERE codiAcord=?');
            $consulta->execute(array($codiEstada,$codiAssignaturaUAB,$codiAsignaturaDesti,$nomAsignaturaDesti,$creditsAsignaturaDesti,$enllaçAssignaturaDesti,$idAcord));
        } catch (Exception $e) {
            
        }

    }
    public function deleteAcord($idAcord){
        try {
            $consulta = $this->db->prepare('DELETE FROM acordestudis WHERE codiAcord=?');
            $consulta->execute(array($idAcord));
            
        } catch (Exception $e) {
            
        }
    }

    public function getURLsAcords(){
        try {
            $consulta = $this->db->prepare('SELECT ac.linkAssignaturaDesti, uni.idUniversitat
                                                        FROM acordestudis ac, universitat uni, estada es, conveni co, centreestudis ce, universitat_estudisuab ues
                                                        WHERE ac.codiEstada = es.codiEstada
                                                        AND es.codiConveni = co.codiConveni
                                                        AND co.codiCentreEstudis = ce.codiCentreEstudis
                                                        AND ce.codiUniEstudis = ues.codiUniEstudis
                                                        AND ues.idUniversitat = uni.idUniversitat');
            $consulta->execute();

            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;

        } catch (Exception $e) {

        }
    }
    public function disconnect(){
        $this->db =null;
    }


}

?>