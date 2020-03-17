<?php

class StateModel
{
    protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }

    public function getAllInfo($idUniversitat){

        $consulta = $this->db->prepare('
                                        SELECT ac.nomAsignaturaDesti,ac.creditsAsignaturaDesti,ass.nomAssignatura, ass.crèdits,ass.url,est.nomGrau,es.curs,estu.niuEstudiant,estu.publicMail,estu.correu, ac.linkAssignaturaDesti
                                        FROM conveni co, estada es,acordestudis ac,assignaturesuab ass,estudisuab est,estudiant estu, centreestudis ce,universitat_estudisuab ue
                                        WHERE co.codiConveni = es.codiConveni
                                        AND ue.idUniversitat= ?
                                        AND ce.codiUniEstudis = ue.codiUniEstudis
                                        AND co.codiCentreEstudis = ce.codiCentreEstudis
                                        AND es.codiConveni = co.codiConveni
                                        AND estu.niuEstudiant = es.niuEstudiant
                                        AND ac.codiEstada = es.codiEstada
                                        AND ass.codiAssignaturaUAB = ac.codiAssignaturaUAB
                                        AND ass.codiEstudis = est.codiEstudis
                    GROUP BY ac.nomAsignaturaDesti,ac.creditsAsignaturaDesti,ass.nomAssignatura, ass.crèdits,ass.url,est.nomGrau,es.curs,estu.niuEstudiant,estu.publicMail,estu.correu,ac.linkAssignaturaDesti');
        $consulta->execute(array($idUniversitat));
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }
    public function getAllInfoByDegree($idUniversitat,$degree){
        $consulta = $this->db->prepare('
                                        SELECT ac.nomAsignaturaDesti,ac.creditsAsignaturaDesti,ass.nomAssignatura, ass.crèdits,ass.url,est.nomGrau,es.curs,estu.niuEstudiant,estu.publicMail,estu.correu,ac.linkAssignaturaDesti
                                        FROM conveni co, estada es,acordestudis ac,assignaturesuab ass,estudisuab est,estudiant estu, centreestudis ce,universitat_estudisuab ue
                                        WHERE co.codiConveni = es.codiConveni
                                        AND es.codiConveni = co.codiConveni
                                        AND ce.codiUniEstudis = ue.codiUniEstudis
                                        AND co.codiCentreEstudis = ce.codiCentreEstudis
                                        AND ue.idUniversitat= ?
                                        AND est.codiEstudis in(?,9999999)
                                        AND estu.niuEstudiant = es.niuEstudiant
                                        AND ac.codiEstada = es.codiEstada
                                        AND ass.codiAssignaturaUAB = ac.codiAssignaturaUAB
                                        AND ass.codiEstudis = est.codiEstudis
                    GROUP BY ac.nomAsignaturaDesti,ac.creditsAsignaturaDesti,ass.nomAssignatura, ass.crèdits,ass.url,est.nomGrau,es.curs,estu.niuEstudiant,estu.publicMail,estu.correu,ac.linkAssignaturaDesti');
        $consulta->execute(array($idUniversitat,$degree));
        if($consulta==false){
            return false;
        }
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;



    }
    public function getInfoCentreEstudis($idUniversitat,$idgrau){
        $consulta = $this->db->prepare('SELECT *
                                        FROM universitat_estudisuab ue, centreestudis ce
                                        WHERE  ue.idUniversitat = ?
                                        AND ue.codiEstudis = ?
                                        AND ue.codiUniEstudis = ce.codiUniEstudis');
        $consulta->execute(array($idUniversitat,$idgrau));
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;

    }

    public function disconnect(){
        $this->db =null;
    }


   
}
?>