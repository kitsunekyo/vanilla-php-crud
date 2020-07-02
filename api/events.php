<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'db/Database.php';
include_once 'controller/EventsController.php';

$method = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$connection = $db->connect();
$eventsController = new EventsController($connection);

switch ($method) {
    case 'GET':
        $eventsController->read();
        break;
    case 'POST':
        $eventsController->create();
        break;
    case 'DELETE':
        $eventsController->delete();
    default:
        break;
}
