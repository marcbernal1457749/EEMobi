<?php

class PublicationsSubjectModel{

	protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }
    public function getPublicationOfUser($niu){
        $consulta = $this->db->prepare('SELECT pu.idPublicació,pu.opinió,pu.fotoPublicació,pu.dataPublicació,es.nom,es.cognom,es.publicNom,es.publicMail,un.nomUniversitat 
                                        FROM publicacions pu, estudiant es, universitats un
                                        WHERE pu.niuEstudiant = es.niuEstudiant
                                        AND es.niuEstudiant = ?
                                        AND pu.idUniversitat = un.idUniversitat
                                        ORDER BY pu.dataPublicació');
        $consulta->execute(array($niu));
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }
    public function getPublicationOfUniversity($idUniversitat){
        $consulta = $this->db->prepare('SELECT pu.idPublicació,pu.opinió,pu.fotoPublicació,pu.dataPublicació,pu.idCategoria,es.nom,es.cognom,es.publicNom,es.foto,es.publicMail,un.nomUniversitat 
                                        FROM publicacions pu, estudiant es, universitats un
                                        WHERE pu.idUniversitat = un.idUniversitat
                                        AND un.idUniversitat = ?
                                        AND pu.niuEstudiant = es.niuEstudiant
                                        GROUP BY pu.idPublicació');
        $consulta->execute(array($idUniversitat));
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }
    public function getPublicationsByFilter($idUniversitat,$filtre,$idCat){
        switch ($filtre) {
            case 1:
                $fil = "pu.dataPublicació ASC";
                break;
            case 2:
                $fil = "pu.dataPublicació DESC";
                break;
            default:
                $fil = "pu.dataPublicació";
                break;
        }

        switch($idCat){
            case -1:
                $cat = "";
                $array = array($idUniversitat);
                break;

            default:
                $cat = "AND pu.idCategoria = ?";
                $array = array($idUniversitat, $idCat);
                break;
        }
        $consulta = $this->db->prepare('SELECT pu.idPublicació,pu.opinió,pu.fotoPublicació,pu.dataPublicació,pu.idCategoria,es.nom,es.cognom,es.publicNom,es.foto,es.publicMail,un.nomUniversitat 
                                        FROM publicacions pu, estudiant es, universitats un
                                        WHERE pu.idUniversitat = un.idUniversitat
                                        AND un.idUniversitat = ? '.$cat.'
                                        AND pu.niuEstudiant = es.niuEstudiant
                                        ORDER BY '.$fil);
        $consulta->execute($array);
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;

    }

    public function getPublicationOfUniversityAndCategory($idUni, $idCat){
        $consulta = $this->db->prepare('SELECT pu.idPublicació,pu.opinió,pu.fotoPublicació,pu.dataPublicació,pu.idCategoria,es.nom,es.cognom,es.publicNom,es.foto,es.publicMail,un.nomUniversitat 
                                        FROM publicacions pu, estudiant es, universitats un
                                        WHERE pu.idUniversitat = un.idUniversitat
                                        AND un.idUniversitat = ?
                                        AND pu.idCategoria = ?
                                        AND pu.niuEstudiant = es.niuEstudiant
                                        GROUP BY pu.idPublicació');
        $consulta->execute(array($idUni, $idCat));
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }

    public function addPublicationSubject($codiAcord,$niu,$text,$data){
        try{
            $consulta = $this->db->prepare("INSERT INTO publicacionsassignatura (codiAcord, niuEstudiant, opinio, dataPublicacio) VALUES (?, ?, ?, ?)");
            $consulta->execute(array($codiAcord,$niu,$text,$data));
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deletePublication($id,$niu){
        try {
            $consulta = $this->db->prepare('DELETE FROM publicacions WHERE idPublicació=? AND niuEstudiant=?');
            $consulta->execute(array($id,$niu));
            
        } catch (Exception $e) {
            
        }

    }

    public function disconnect(){
        $this->db =null;
    }


}

?>