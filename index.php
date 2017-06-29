<?php
/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 11/06/2017
 * Time: 11:40
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "database/connection.php";
include_once "config/autoload.php";
session_start();

include_once "controllers/routes.php";