<?php

class PublicationsSubjectModel{

	protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }
    public function getPublicationOfUser($niu){
        $consulta = $this->db->prepare('SELECT pu.idPublicacio,pu.opinio,pu.dataPublicacio,es.nom,es.cognom,es.publicNom,es.foto,es.publicMail,ae.nomAsignaturaDesti
                                        FROM publicacionsassignatura pu, estudiant es, acordestudis ae
                                        WHERE pu.niuEstudiant = es.niuEstudiant
                                        AND es.niuEstudiant = ?
                                        AND pu.codiAcord = ae.codiAcord
                                        ORDER BY pu.dataPublicacio');
        $consulta->execute(array($niu));
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }

    public function getAllSubjectPublications(){
        $consulta = $this->db->prepare('SELECT * FROM publicacionsassignatura');
        $consulta->execute();
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }
    public function getPublicationOfSubject($idSubject){
        $consulta = $this->db->prepare('SELECT pu.idPublicacio,pu.opinio,pu.dataPublicacio,es.nom,es.cognom,es.publicNom,es.foto,es.publicMail,ae.nomAsignaturaDesti
                                        FROM publicacionsassignatura pu, estudiant es, acordestudis ae
                                        WHERE pu.codiAcord = ae.codiAcord
                                        AND pu.codiAsignaturaDesti = ?
                                        AND pu.niuEstudiant = es.niuEstudiant
                                        GROUP BY pu.idPublicacio');
        $consulta->execute(array($idSubject));
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }

    public function addPublicationSubject($codiAcord,$niu,$text,$data,$codiAsignaturaDesti){
        try{
            $consulta = $this->db->prepare("INSERT INTO publicacionsassignatura (codiAcord, niuEstudiant, opinio, dataPublicacio, codiAsignaturaDesti) VALUES (?, ?, ?, ?,?)");
            $consulta->execute(array($codiAcord,$niu,$text,$data,$codiAsignaturaDesti));
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deletePublication($id,$niu){
        try {
            $consulta = $this->db->prepare('DELETE FROM publicacionsassignatura WHERE idPublicacio=? AND niuEstudiant=?');
            $consulta->execute(array($id,$niu));
            
        } catch (Exception $e) {
            
        }

    }

    public function disconnect(){
        $this->db =null;
    }


}

?>