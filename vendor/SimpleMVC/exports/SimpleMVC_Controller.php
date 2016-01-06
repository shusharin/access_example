<?php

/**
 * Controller
 *
 * @author Valery Shusharin <shusharin_valery@mail.ru>
 */
class SimpleMVC_Controller {
    
    /**
     * Request
     * @var \SimpleMVC\Request 
     */
    protected $_request;
    
    /**
     * App
     * @var \SimpleMVC\App 
     */
    protected $_app;

    /**
     * Config
     * @var \SimpleMVC\Config 
     */
    protected $_config;

    public function __construct() {
        
        $this->_request = \SimpleMVC\Request::instance();
        $this->_app = \SimpleMVC\App::instance();
        $this->_config = new \SimpleMVC\Config();
    }
}
