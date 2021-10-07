<?php 

class Conexao {
    private $data = array(); 
    protected $pdo = null;

    public function __set($name, $value)
    {

    $this->data[$name] = $value;

    } 
    public function __get($name){       
    if (array_key_exists($name, $this->data)) 
    {
         return $this->data[$name]; 
    }

    $trace = debug_backtrace();
    trigger_error( 'Undefined property via __get(): ' . $name . ' in ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'], E_USER_NOTICE);
    return null; 
    }

    public function getPdo() {

     return $this->pdo; 
    } 
    function __construct($pdo = null) { 
        $this->pdo = $pdo;
         if ($this->pdo == null) $this->conectar();
         } 
         public function conectar() { 
             try {
                  $this->pdo = new PDO("mysql:host=localhost;dbname=exelteste", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
                }
                 catch (PDOException $e) 
                 {
                      print "Error!: " . $e->getMessage() . "<br/>"; die(); 
                } 
            }
        public function desconectar() 
        {
             $this->pdo = null;
         }
        public function select($sql){
     $stmt = $this->pdo->prepare($sql);
     $stmt->execute();
     return $stmt->fetchAll(PDO::FETCH_ASSOC); 
     }
     
     } ?>