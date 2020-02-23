<?php

class RatingsModel
{
    protected $db;

    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }


    public function getStudentRatings($idEstada){
        $consulta = $this->db->prepare('SELECT * FROM valoracions WHERE idEstada=? ORDER BY idCategoria');
        $consulta->execute(array($idEstada));
        $rows = $consulta->fetchAll();

        return $rows;
    }

    public function getRatingsByUni($idUni){
        $consulta = $this->db->prepare('SELECT * FROM valoracions WHERE idUniversitat=? ORDER BY idCategoria');
        $consulta->execute(array($idUni));
        $rows = $consulta->fetchAll();

        return $rows;
    }

    public function getCategories(){
        $consulta = $this->db->prepare('SELECT * FROM categoriavaloracions ORDER BY idCategoria');
        $consulta->execute();
        $rows = $consulta->fetchAll();

        return $rows;
    }

    public function addRating($idEstada, $idUni, $idCategoria, $valor){
        $consulta = $this->db->prepare('INSERT INTO valoracions (score,idUniversitat,idEstada, idCategoria) VALUES(?,?,?,?)');
        $consulta->execute(array($valor, $idUni, $idEstada, $idCategoria));
    }

    public function editRating($idVal, $score){
        $consulta = $this->db->prepare("UPDATE valoracions SET score =? WHERE idValoracio =?");
        $consulta->execute(array($score, $idVal));
    }

    public function disconnect(){
        $this->db =null;
    }
}