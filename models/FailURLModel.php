<?php

class FailURLModel{
    protected $db;

    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }
    public function addFailURL($modul,$url,$ubicacio){
        try {
            $consulta = $this->db->prepare("INSERT INTO urlfallides(data,modul,url,ubicacio) VALUES (now(),?,?,?)");
            $consulta->execute(array($modul,$url,$ubicacio));

        } catch (Exception $e) {
            $obj = $e;
        }

    }
    public function getFailURL($modul){
        try {
            //realizamos la consulta de todos los items
            $consulta = $this->db->prepare('SELECT * FROM urlfallides WHERE modul=?');
            $consulta->execute(array($modul));
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {

        }

        //devolvemos la colección para que la vista la presente.
        return $obj;
    }

    public function disconnect(){
        $this->db =null;
    }



}