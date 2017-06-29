<?php

/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 11/06/2017
 * Time: 18:20
 */

class BaseController
{
    public function render($view, $d=null)
    {
        global $datas;
        $datas = $d;
        $classname = get_called_class();
        $classname = substr($classname, 0, -10);
        include_once $_SERVER["DOCUMENT_ROOT"]."/views/header.php";
        include_once $_SERVER["DOCUMENT_ROOT"]."/views/".$classname."/".$view.".php";
        include_once $_SERVER["DOCUMENT_ROOT"]."/views/footer.php";
    }

    public function redirect($location)
    {
        header('Location: '.$location);
        exit;
    }

}