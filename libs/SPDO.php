<?php
class SPDO extends PDO
{
    private static $instance = null;
 
    public function __construct(){
        $config = Config::getInstance();
        //herencia del constructor del pare PDO("mysql:host=;dbname=", $dbuser, $pdbpass);
        try{
            parent::__construct('mysql:host=' . $config->get('dbhost') . ';dbname=' . $config->get('dbname') .';charset=utf8',$config->get('dbuser'), $config->get('dbpass'));
        }catch(PDOException $e){
            die("Connection failed: " . $e->getMessage());
        }
    }
 
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function closeConnectionDB(){
        self::$instance = null;
    }
}
?>