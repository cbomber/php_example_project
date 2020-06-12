<?php
class db {

    protected $host;
    protected $user;
    protected $pass;
    protected $dbname;
    protected $db_conn_mode = "pdo";
    protected $db;
    protected $lastInsertId;

    public function __construct(array $settings){
        $this->host = $settings['host'];
        $this->user = $settings['user'];
        $this->pass = $settings['pass'];
        $this->dbname = $settings['dbname'];
        $this->connect();
    }

    public function connect(){
        switch($this->db_conn_mode){
            case 'mysqli':
                $mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
                if ($mysqli->connect_error) {
                    die('Connect Error (' . $mysqli->connect_errno . ') '
                            . $mysqli->connect_error);
                }
                if (mysqli_connect_error()) {
                    die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
                }
                $this->db = $mysqli;//$mysqli->close();
            break;
            case 'pdo':
                try {
                    $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    die('Connection failed: ' . $e->getMessage());
                }
                $this->db = $pdo;
            break;
        }
    }

    public function prepare($sql){
        return $this->db->prepare($sql);
    }

    public function getLastInsertId(){
        return $this->lastInsertId;
    }

}
