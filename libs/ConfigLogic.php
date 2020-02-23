<?php
class ConfigLogic{
    private $variable;
    private static $instance;


    private function __construct(){
        $this->varibale = array();
    }
 
    public static function getInstance(){
        if (!isset(self::$instance)) {
            $conf = __CLASS__;
            self::$instance = new $conf;
        }
 
        return self::$instance;
    }

    public function set($name, $value){
        if(!isset($this->variable[$name]))
        {
            $this->variable[$name] = $value;
        }
    }
 

    public function get($name){
        if(isset($this->variable[$name]))
        {
            return $this->variable[$name];
        }
    }

}

?>