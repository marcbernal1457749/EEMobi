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

}