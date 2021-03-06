<?php

/**
 * system config
 */
return [
    /**
     * uri suffix
     * @example www.example.com/mySyffix/controllerName/actionName
     */
    'uri_suffix' => '',
    'default_controller' => 'Home',
    'default_action' => 'show_main',
    'app_path' => DOCROOT . 'app' . DIRECTORY_SEPARATOR,
    'controllers_dir' => 'controllers',
    'controllers_suffix' => 'Controller',
    'action_suffix' => '',
    'base_controllers' => ['Base'],
];
