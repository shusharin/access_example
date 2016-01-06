<?php

define('SimpleMVC_DOCROOT', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

require_once SimpleMVC_DOCROOT . 'Config.php';
require_once SimpleMVC_DOCROOT . 'Request.php';
require_once SimpleMVC_DOCROOT . 'exports'. DIRECTORY_SEPARATOR .'SimpleMVC_Controller.php';
require_once SimpleMVC_DOCROOT . 'exports'. DIRECTORY_SEPARATOR .'SimpleMVC_Model.php';
require_once SimpleMVC_DOCROOT . 'App.php';

$App = SimpleMVC\App::instance();
$App->start();