<?php

// Set the full path to the docroot
define('DOCROOT', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define('APP_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR);
define('VENDOR_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR);

include DOCROOT . 'bootstrap.php';
include VENDOR_PATH . 'SimpleMVC' . DIRECTORY_SEPARATOR . 'autoload.php';


