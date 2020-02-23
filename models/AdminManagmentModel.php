<?php

class AdminManagmentModel{

    protected $db;

    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }

    //Inicio funciones Footer
    public function getFooterInfo(){
        $consulta = $this->db->prepare('SELECT * FROM seccionsfooter ORDER BY footerId');
        $consulta->execute();
        $rows = $consulta->fetchAll();

        return $rows;
    }

    public function editFooterInfo($id, $titol){
        $consulta = $this->db->prepare('UPDATE seccionsfooter SET titolSeccio =? WHERE footerId =?');
        $consulta->execute(array($titol,intval($id)));
    }

    public function getSubSections(){
        $consulta = $this->db->prepare('SELECT * FROM apartatsseccions ORDER BY idSeccio');
        $consulta->execute();
        $rows = $consulta->fetchAll();

        return $rows;
    }

    public function getSubSectionsById($id){
        $consulta = $this->db->prepare('SELECT * FROM apartatsseccions WHERE idSeccio = ? ORDER BY idSeccio');
        $consulta->execute(array($id));
        $rows = $consulta->fetchAll();

        return $rows;
    }

    public function addSubSection($titol, $url, $section){
        $consulta = $this->db->prepare('INSERT INTO apartatsseccions (titolApartat,urlApartat,idSeccio) VALUES(?,?,?)');
        $consulta->execute(array($titol,$url,$section));

        return $this->db->lastInsertId();
    }

    public function deleteSubSection($idSubSection){
        $consulta = $this->db->prepare('DELETE FROM apartatsseccions WHERE idApartat =?');
        $consulta->execute(array($idSubSection));
    }

    public function editSubSection($id, $titol, $url){
        $consulta = $this->db->prepare("UPDATE apartatsseccions SET titolApartat =?, urlApartat =? WHERE idApartat =?");
        $consulta->execute(array($titol,$url,$id));
    }

    public function getURLSubsection(){
        $consulta = $this->db->prepare('SELECT urlApartat, titolApartat FROM apartatsseccions ORDER BY idSeccio');
        $consulta->execute();
        $rows = $consulta->fetchAll();

        return $rows;
    }
    //Fin funciones footer

    public function disconnect(){
        $this->db =null;
    }


}

?>
