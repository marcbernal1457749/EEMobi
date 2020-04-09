<?php

class CountriesModel{

	protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }
 
    public function getCountry()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT idPais,nomPais FROM pais ORDER BY nomPais');
        $consulta->execute();
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;
    }
    public function getCountryByProgram($idProgram){
        $consulta = $this->db->prepare('SELECT idPais,nomPais FROM pais WHERE codiPrograma = ?');
        $consulta->execute(array($idProgram));
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;

    }
    public function getCountryIdByName($nameCountry){
        $consulta = $this->db->prepare('SELECT idPais FROM pais WHERE nomPais=?');
        $consulta->execute(array($nameCountry));
        $obj = $consulta->fetch(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;

    }

    public function getCountryById($idCountry){
        $consulta = $this->db->prepare('SELECT * FROM pais WHERE idPais=?');
        $consulta->execute(array($idCountry));
        $obj = $consulta->fetch(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;

    }

    public function addCountry($codiPrograma,$nomPais){
        try {
            $consulta = $this->db->prepare("INSERT INTO pais(codiPrograma,nomPais) VALUES (?,?)");
            $consulta->execute(array($codiPrograma,$nomPais));

        } catch (Exception $e) {
            $obj = $e;
        }

    }

    public function deleteCountry($idCountry){
        $consulta = $this->db->prepare('DELETE FROM pais WHERE idPais =?');
        $consulta->execute(array($idCountry));
    }

    public function editCountry($id, $nom){
        $consulta = $this->db->prepare('UPDATE pais SET nomPais =? WHERE idPais =?');
        $consulta->execute(array($nom,$id));
    }

    public function disconnect(){
        $this->db =null;
    }


}

?>