<?php

$parameters = array();

foreach ($_POST as $param => $value)
    $parameters[$param] = $value;
foreach ($_GET as $param => $value)
    $parameters[$param] = $value;

function parameters(){
    global $parameters;
    return $parameters;
}

if(isset($parameters["r"])){
    list($model, $action) = explode("/", $parameters["r"]);
    $controller = ucfirst($model)."Controller";
    $model = new $controller();
    $model->$action();
}
else{
    $site = new SiteController();
    $site->index();
}