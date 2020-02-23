<?php

class StayModel{

	protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }
    public function getStays(){
        try{
            $consulta = $this->db->prepare('SELECT es.codiEstada,es.codiConveni,es.niuEstudiant,es.curs,es.semestre,est.nom,est.cognom
                                            FROM estada es, estudiant est
                                            WHERE es.niuEstudiant = est.niuEstudiant');
            $consulta->execute();
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }

    }

    public function getStaysById($id){
        try{
            $consulta = $this->db->prepare('SELECT * FROM estada WHERE codiEstada=?');
            $consulta->execute(array($id));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getUniStays($idUni){
        try{
            $consulta = $this->db->prepare('SELECT es.codiEstada,es.codiConveni,es.niuEstudiant,es.curs,es.semestre,pr.nom as profNom,pr.cognoms as profCognom,est.nom as nomEst,est.cognom as cognomEst
                                            FROM estada es, estudiant est,universitats uni, universitat_estudisuab estuab, centreestudis centre, conveni co, professors pr
                                            WHERE uni.idUniversitat = estuab.idUniversitat
                                            AND estuab.codiUniEstudis = centre.codiUniEstudis
                                            AND centre.codiCentreEstudis = co.codiCentreEstudis
                                            AND co.codiConveni = es.codiConveni
                                            AND es.niuProfessor = pr.niuProfessor
                                            AND es.niuEstudiant = est.niuEstudiant
                                            AND uni.idUniversitat =?');
            $consulta->execute(array($idUni));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getStay($niu){
        try{
            $consulta = $this->db->prepare('SELECT  un.nomUniversitat,es.semestre, es.curs, ac.nomAsignaturaDesti,ac.creditsAsignaturaDesti
                FROM conveni co, estada es, acordestudis ac, universitats un,centreestudis ce, universitat_estudisuab ue
                WHERE co.codiCentreEstudis = ce.codiCentreEstudis
                AND co.codiConveni = es.codiConveni
                AND ce.codiUniEstudis = ue.codiUniEstudis
                AND un.idUniversitat = ue.idUniversitat
                AND es.codiEstada = ac.codiEstada
                AND es.niuEstudiant = ?
                GROUP BY un.nomUniversitat,es.semestre, es.curs, ac.nomAsignaturaDesti,ac.creditsAsignaturaDesti
                ');
            $consulta->execute(array($niu));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function isStay($niu){
        /*try{
            $consulta = $this->db->prepare('SELECT  un.nomUniversitat,es.semestre, es.curs, es.codiEstada, un.idUniversitat
                FROM conveni co, estada es, universitats un,centreestudis ce, universitat_estudisuab ue
                WHERE co.codiCentreEstudis = ce.codiCentreEstudis
                AND co.codiConveni = es.codiConveni
                AND ce.codiUniEstudis = ue.codiUniEstudis
                AND un.idUniversitat = ue.idUniversitat
                AND es.niuEstudiant = ?
                GROUP BY un.nomUniversitat,es.semestre, es.curs, un.idUniversitat');
            $consulta->execute(array($niu));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }*/
        try{
            $consulta = 'SELECT  un.nomUniversitat,es.semestre, es.curs, es.codiEstada, un.idUniversitat
                FROM conveni co, estada es, universitats un,centreestudis ce, universitat_estudisuab ue
                WHERE co.codiCentreEstudis = ce.codiCentreEstudis
                AND co.codiConveni = es.codiConveni
                AND ce.codiUniEstudis = ue.codiUniEstudis
                AND un.idUniversitat = ue.idUniversitat
                AND es.niuEstudiant = ?
                GROUP BY un.nomUniversitat,es.semestre, es.curs, es.codiEstada, un.idUniversitat';
            $stmt = $this->db->prepare($consulta);
            $stmt->bindValue(1,$niu);
            $stmt->execute();
            $obj = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $obj;

        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function addStay($niuEstudiant,$codiConveni,$curs,$semestre, $niuProfessor){
        //realizamos la consulta de todos los items
        try {
            $consulta = $this->db->prepare('INSERT INTO estada(niuEstudiant,codiConveni,curs,semestre,niuProfessor) VALUES (?,?,?,?,?)');
            $consulta->execute(array($niuEstudiant,$codiConveni,$curs,$semestre,$niuProfessor));

            $id = $this->db->lastInsertId();
            return $id;
        } catch (Exception $e) {
            
        }

    }
    public function updateStay($niuEstudiant,$codiConveni,$curs,$semestre,$idEstada){
        //realizamos la consulta de todos los items
        try {
            $consulta = $this->db->prepare('UPDATE estada SET niuEstudiant = ?, codiConveni = ?, curs = ?, semestre = ? WHERE codiEstada=?');
            $consulta->execute(array($niuEstudiant,$codiConveni,$curs,$semestre,$idEstada));   
        } catch (Exception $e) {
            
        }

    }
    public function deleteStay($idEstada){
        try {
            $consulta = $this->db->prepare('DELETE FROM estada WHERE codiEstada=?');
            $consulta->execute(array($idEstada));
            
        } catch (Exception $e) {
            
        }
    }
    public function getStayWithTeacher($niuProfessor,$codiConveni){
        try{
            $consulta = $this->db->prepare('SELECT es.nom,es.cognom,es.niuEstudiant,est.codiEstada FROM professorscentre pc, estada est, estudiant es
                                            WHERE pc.niuProfessor = ?
                                            AND est.codiConveni = ?
                                            AND est.niuEstudiant = es.niuEstudiant
                                            GROUP BY es.nom,es.cognom,es.niuEstudiant,est.codiEstada
                                            ');
            $consulta->execute(array($niuProfessor,$codiConveni));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }

    }
    public function disconnect(){
        $this->db =null;
    }



}

?>