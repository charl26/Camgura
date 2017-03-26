<?php

/**
 * Created by PhpStorm.
 * User: bbdnet1571
 * Date: 2017/03/24
 * Time: 5:42 PM
 */
class user extends user_management
{
	/**
    * @param $not_hashed_password : the password that is not hashed
    * @return string : the hashed password
    */
   private function password_hashing($not_hashed_password)
   {
       $hash = array();
	   foreach(str_split($not_hashed_password) as $value) {
           $value = hash("md5", $value);
           array_push($hash, $value);
       }
       $hashed_password = implode("" ,$hash);
       $hashed_password = hash("whirlpool", $hashed_password);
       return($hashed_password);
   }

}