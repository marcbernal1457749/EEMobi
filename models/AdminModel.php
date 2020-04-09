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
        $consulta = $this->db->prepare('SELECT nomAdmin,usuariAdmin,idAdmin FROM administrador WHERE usuariAdmin = ?');
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
    public function getAdmins()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM administrador ORDER BY nomAdmin');
        $consulta->execute();
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }
    public function addAdmin($niu,$nom){
        try {
            $consulta = $this->db->prepare("INSERT INTO administrador(idAdmin,nomAdmin,usuariAdmin) VALUES (?,?,?)");
            $consulta->execute(array($niu,$nom,'admin'));

        } catch (Exception $e) {
            $obj = $e;
        }

    }
    public function deleteAdmin($niu){
        $consulta = $this->db->prepare('DELETE FROM administrador WHERE idAdmin =?');
        $consulta->execute(array($niu));
    }

    public function disconnect(){
        $this->db =null;
    }


}

?>