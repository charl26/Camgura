<?php

/**
 * Created by PhpStorm.
 * User: bbdnet1571
 * Date: 2017/03/24
 * Time: 5:43 PM
 */
require_once ("user.class.php");
class authorisation extends user_management
{
	public function login_user()
	{
		$login = $_POST['login'];
		$_SESSION['user'] = $login;
		$pass = $_SESSION['password'];
		$hashPassword = password_hash($pass);
		$_SESSION['password'] = $hashPassword;
		$check = $this->query("SELECT USERNAME FROM `users`");
		foreach ($check as $row) {
			if ($row['USERNAME'] == $_POST['login']) {
				$check = $this->query('SELECT PASSWORD FROM users');
				foreach ($check as $row) {
					if ($row['PASSWORD'] == $pass) {
						$check = $this->query('SELECT ACTIVE FROM users');
						foreach ($check as $row) {
							if ($row['ACTIVE'] == true) {
								$_SESSION['login'] = $_POST['login'];
								$_SESSION['password'] = $_POST['password'];
								//redirect to main page;
							} else {
								//error
							}
						}
					} else {
						//error
					}
				}
			} else {
				//error
			}
		}
	}


}