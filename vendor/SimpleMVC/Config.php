<?php

namespace SimpleMVC;

/**
 * Config
 *
 * @author Valery Shusharin <shusharin_valery@mail.ru>
 */
class Config {

    /**
     * Get config
     * @param string $name
     */
    public function __get($name) {

        $simple_mvc_root = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR;

        // Is the config file in the environment folder?
        if (!defined('DOCROOT') || !file_exists($file_path = DOCROOT . 'config' . DIRECTORY_SEPARATOR . (string) $name . '.php'))
            $file_path = $simple_mvc_root . 'config' . DIRECTORY_SEPARATOR . $name . '.php';

        // Fetch the config file
        if (!file_exists($file_path))
            return array();

        $config = require($file_path);
        return $config;
    }

}
