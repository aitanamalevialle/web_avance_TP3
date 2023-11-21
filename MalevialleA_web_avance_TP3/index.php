<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_write_close();
session_start();

define('PATH_DIR', 'https://e2395216.webdev.cmaisonneuve.qc.ca/MalevialleA_web_avance_TP3/');

require_once('controller/Controller.php');
require_once('library/RequirePage.php');
require_once __DIR__.'/vendor/autoload.php';
require_once('library/Twig.php');
require_once('library/CheckSession.php');

function showError404() {
    header("HTTP/1.0 404 Not Found");
    echo Twig::render('error404.php');
    exit;
}

$url = isset($_GET["url"]) ? explode ('/', ltrim($_GET["url"], '/')) : '/';

if ($url == '/') {
    require_once('controller/ControllerHome.php');
    $controller = new ControllerHome;
    echo $controller->index();
} else {
    $requestURL = ucfirst($url[0]);
    $controllerPath = __DIR__."/controller/Controller".$requestURL.".php";
    if (file_exists($controllerPath)) {
        require_once($controllerPath);
        $controllerName = 'Controller'.$requestURL;
        if (class_exists($controllerName)) {
            $controller = new $controllerName;
            $method = $url[1] ?? 'index';
            if (method_exists($controller, $method)) {
                echo call_user_func_array([$controller, $method], array_slice($url, 2));
            } else {
                showError404();
            }
        } else {
            showError404();
        }
    } else {
        showError404();
    }
}

?>