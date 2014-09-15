<?php
/**
 * Description of encryptPassword
 *
 * @author Fernando
 */
class EncryptPassword {

    public static function encrypt($password){
        $salt = substr($password,0,12);
        return crypt($password,$salt);
    }
    
}
