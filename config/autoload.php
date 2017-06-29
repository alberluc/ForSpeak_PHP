<?php

function classAutoLoader($class){
    if(substr($class, -10, 10) == "Controller")
        $path = $_SERVER["DOCUMENT_ROOT"]."/controllers/".$class.".php";
    else
        $path = $_SERVER["DOCUMENT_ROOT"]."/class/".$class.".php";
    include $path;
}
spl_autoload_register('classAutoLoader');