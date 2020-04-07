<?php

class TeachersModel{

	protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }

    //Arreglar
    public function getIdTeacherByName($teacherName){
        try{

            $nom = explode(" ", $teacherName);
            $teacherName = $nom[0];
            $teacherSurename = $nom[1];

            $consulta = $this->db->prepare('SELECT niuProfessor
                                            FROM professors
                                            WHERE 
                                            cognoms =? AND
                                            nom =?');
            $consulta->execute(array($teacherSurename, $teacherName));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getTeacherByDegree($idDegree,$idUniversitat){
        try{
            $consulta = $this->db->prepare('SELECT pr.niuProfessor,pr.nom,pr.cognoms,pr.codiEstudis,pr.correuProfessor,pr.correuPublic,pr.nomPublic
                                            FROM professors pr, centreestudis ce, universitat_estudisuab ue,professorscentre pc
                                            WHERE pc.codiCentreEstudis = ce.codiCentreEstudis
                                            AND pr.niuProfessor = pc.niuProfessor
                                            AND ce.codiUniEstudis = ue.codiUniEstudis
                                            AND ue.codiEstudis = ?
                                            AND ue.idUniversitat = ?');
            $consulta->execute(array($idDegree,$idUniversitat));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function isTeacher($niu){
        try{
            $consulta = $this->db->prepare('SELECT * FROM professors WHERE niuProfessor = ?');
            $consulta->execute(array($niu));
            $obj = $consulta->fetch(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getTeachers(){
        try{
            $consulta = $this->db->prepare('SELECT pr.nom, pr.cognoms, es.nomGrau, pr.correuProfessor,pr.niuProfessor
                                            FROM professors pr, estudisuab es
                                            WHERE pr.codiEstudis = es.codiEstudis ORDER BY pr.nom ASC');
            $consulta->execute();
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getTeachersOfUniversity($idUniversitat){
        try{
            $consulta = $this->db->prepare('SELECT pr.nom, pr.cognoms, es.nomGrau, pr.correuProfessor,pr.niuProfessor
                                            FROM professors pr, centreestudis ce, universitat_estudisuab ue,professorscentre pc, estudisuab es
                                            WHERE pc.codiCentreEstudis = ce.codiCentreEstudis
                                            AND pr.niuProfessor = pc.niuProfessor
                                            AND ce.codiUniEstudis = ue.codiUniEstudis
                                            AND pr.codiEstudis = es.codiEstudis
                                            AND ue.idUniversitat = ?
                                            GROUP BY  pr.nom, pr.cognoms, es.nomGrau, pr.correuProfessor,pr.niuProfessor');
            $consulta->execute(array($idUniversitat));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getAgreementsTeacher($niu){
        try {
            $consulta = $this->db->prepare('SELECT ce.plaçes, ce.mesos, ce.període , un.nomUniversitat ,un.idUniversitat,co.codiConveni
                                            FROM professorscentre pr, centreestudis ce, universitat_estudisuab ue, universitats un, conveni co
                                            WHERE pr.niuProfessor = ?
                                            AND ce.codiCentreEstudis = pr.codiCentreEstudis
                                            AND ce.codiUniEstudis = ue.codiUniEstudis
                                            AND un.idUniversitat = ue.idUniversitat
                                            AND co.codiCentreEstudis = ce.codiCentreEstudis
                                            ORDER BY un.nomUniversitat');
            $consulta->execute(array($niu));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $obj;
        } catch (Exception $e) {
            
        }
    }
    public function updateInfoTeacher($niu,$nom,$cognom,$mail,$nomPublic,$correuPublic){
        try {
            $consulta = $this->db->prepare('
            UPDATE professors 
            SET nom=?,cognoms=?,correuProfessor=?,nomPublic=?,correuPublic=? 
            WHERE niuProfessor=?');
        $consulta->execute(array($nom,$cognom,$mail,$nomPublic,$correuPublic,$niu));
        } catch (Exception $e) {
            
        }
    }

    public function insertPhotoOnUser($niu,$photo){
        try{
            $consulta = $this->db->prepare('UPDATE professors SET fotoProfessor=? WHERE niuProfessor=?');
            $consulta->execute(array($photo,$niu));
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function insertCenterOnTeacher($niu,$idcentre){
        try{
            $consulta = $this->db->prepare('INSERT INTO professorscentre(niuProfessor,codiCentreEstudis) VALUES (?,?)');
            $consulta->execute(array($niu,$idcentre));
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function updateCenterOnTeacher($niu,$idcentre){
        try{
            $consulta = $this->db->prepare('UPDATE professorscentre SET niuProfessor=? WHERE codiCentreEstudis =?');
            $consulta->execute(array($niu,$idcentre));
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function addTeacher($niu,$nom,$cognoms,$codiEstudis,$correu){
        try {
            $consulta = $this->db->prepare("INSERT INTO professors(niuProfessor,nom,cognoms,codiEstudis,correuProfessor) VALUES (?,?,?,?,?)");
            $consulta->execute(array($niu,$nom,$cognoms,$codiEstudis,$correu));

        } catch (Exception $e) {
            $obj = $e;
        }

    }
    public function deleteTeachers($niu){
        $consulta = $this->db->prepare('DELETE FROM professors WHERE niuProfessor =?');
        $consulta->execute(array($niu));
    }


    public function disconnect(){
        $this->db =null;
    }


}

?>