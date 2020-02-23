<?php

class AdminModel{

	protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }
 
    public function getUserAdmin($user)
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT nomAdmin,usuariAdmin,contrasenya,idAdmin FROM administrador WHERE usuariAdmin = ?');
        $consulta->execute(array($user));
        $obj = $consulta->fetch(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }
    public function getNiuAdmin($user)
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT idAdmin,nomAdmin FROM administrador WHERE idAdmin = ?');
        $consulta->execute(array($user));
        $obj = $consulta->fetch(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }
    public function disconnect(){
        $this->db =null;
    }


}

?>