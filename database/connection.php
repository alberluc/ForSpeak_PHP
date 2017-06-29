<?php
/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 11/06/2017
 * Time: 17:55
 */

$db = null;

try {
    $db = new PDO("mysql:host=localhost;dbname=forspeak;charset=utf8", "root", "");
}catch (Exception $e){
   throw new Exception($e->getMessage());
}

if($db != null) {
    function db()
    {
        global $db;
        return $db;
    }
}