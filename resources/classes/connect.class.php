<?php

/**
 * Created by PhpStorm.
 * User: bbdnet1571
 * Date: 2017/03/23
 * Time: 12:40 PM
 */
require_once ("../config.php");
class connect {
    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;

    private $dbh;
    private $error;
    private $stmt;

    public function __construct() {
        // Set DSN
        $DSN = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8';
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    		=> true,
            PDO::ATTR_ERRMODE           	=> PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE 	=> PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   	=> false,
        );
        // Create a new PDO instance
        try{
            $this->dbh = new PDO($DSN, $this->user, $this->pass, $options);
        }
            // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }

    }

    //
    // method functions
    //

    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    //
    //binds the inputs with the placeholders that are put in place.
    //

    public function bind($param, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        /** @noinspection PhpUndefinedMethodInspection */
        $this->stmt->bindValue($param, $value, $type);
    }

    //
    //The execute method executes the prepared statement.
    //

    public function execute(){
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->stmt->execute();
    }

    //
    // Result Set function returns an array of the result set rows.
    //

    public function resultset(){
        $this->execute();
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //
    //Single method simply returns a single record from the database
    //

    public function single(){
        $this->execute();
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    //
    // returns the number of effected rows.
    //

    public function rowCount(){
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->stmt->rowCount();
    }
}
