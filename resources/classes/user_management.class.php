<?php

/**
 * Created by PhpStorm.
 * User: bbdnet1571
 * Date: 2017/03/23
 * Time: 12:41 PM
 */

class user_management extends connect {

    private $database;

    public function __construct()
    {
        $this->database = new connect();
    }

    public function get_user_by_username($username){
    	$this->database->query("SELECT * FROM `user` WHERE USERNAME='$username'");
    }

    public function create_user($username, $password, $first_name, $last_name, $biography, $email, $age) {
        /** @noinspection SqlNoDataSourceInspection //TODO update when database source in configured */
	    $this->database->query("INSERT INTO users (USERNAME, PASSWORD, FIRST_NAME, LAST_NAME, AGE, BIO, EMAIL)
			VALUES(:USER, :PASS, :FIRST, :LAST, :AGE, :BIO, :EMAIL,");
        $this->database->bind(':USER', $username);
        $this->database->bind(':PASS', $password);
        $this->database->bind(':FIRST', $first_name);
        $this->database->bind(':LAST', $last_name);
        $this->database->bind(':BIO', $biography);
        $this->database->bind(':EMAIL', $email);
        $this->database->bind(':AGE', $age);
        $this->database->execute();
    }

    public function update_user() {
    	//TODO add update user profile
    }

}