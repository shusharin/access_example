<?php

namespace SimpleMVC;

/**
 * Request
 *
 * @author Valery Shusharin <shusharin_valery@mail.ru>
 */
class Request {

    /**
     * instance (singleton)
     * @var \SimpleMVC\Request 
     */
    private static $instance;

    /**
     *
     * @var array 
     */
    private $config;

    /**
     *
     * @var string
     */
    private $controller;

    /**
     *
     * @var string 
     */
    private $action;

    /**
     *
     * @var string 
     */
    private $controller_default;

    /**
     *
     * @var string 
     */
    private $action_default;

    /**
     *
     * @var string 
     */
    private $uri;

    /**
     *
     * @var array 
     */
    private $get;

    private function __construct() {
        // get system config
        $conf = new Config();
        $this->config = $conf->system;
        $this->controller_default = $this->config['default_controller'];
        $this->action_default = $this->config['default_action'];
        $this->parse_route();
    }

    /**
     * instance Request
     * @return \SimpleMVC\Request
     */
    public static function instance() {
        if (!self::$instance)
            self::$instance = new Request ();

        return self::$instance;
    }

    /**
     * parse current route
     * @return boolean
     */
    private function parse_route() {

        $suffix = isset($this->config['suffix']) ? $this->config['suffix'] : '';
        $request_uri = ltrim(!!$suffix ? str_replace($suffix . '/', "", $_SERVER['REQUEST_URI']) : $_SERVER['REQUEST_URI'], '/');
        
        $params = explode('/', $request_uri);
        
        if (count($params) < 2) {
            $this->controller = $this->controller_default;
            $this->action = $this->action_default;
            return FALSE;
        }

        $this->controller = ucfirst($params[0]);
        unset($params[0]);

        $action = $uri = array();
        foreach ($params as $key => $value) {
            if (!preg_match('/[^a-zA-Z0-9-_\s]/', $value) && !empty($value)) {
                $action[] = $value;
            } else {
                $uri[] = $value;
            }
        }

        $this->action = !empty($action) ? strtolower(implode('_', $action)) : $this->action_default;
        $this->uri = implode('', $uri);
        $this->get = self::get();
        return FALSE;
    }

    /**
     * Get controller
     * @param bool $forse - forse parse route
     * @return string
     */
    public function get_controller($forse = FALSE) {
        if ($this->controller === NULL || $forse)
            self::parse_route();
        
        $controllers_suffix = isset($this->config['controllers_suffix']) ? $this->config['controllers_suffix'] : '';
        
        return $this->controller . $controllers_suffix;
    }

    /**
     * Get action
     * @param bool $forse - forse parse route
     * @return string
     */
    public function get_action($forse = FALSE) {
        if ($this->action === NULL || $forse)
            self::parse_route();

        $action_suffix = isset($this->config['action_suffix']) ? $this->config['action_suffix'] : '';
        
        return $this->action;
    }

    /**
     * Get POST data
     * @param string $key - get key from $_POST
     * @param mixed $default - dafeult value
     * @param bool $isCleanXss - is xss_clean (default TRUE)
     * @return mixed - default array
     */
    public static function post($key = NULL, $default = NULL, $isCleanXss = TRUE) {
        // @todo  SecurityExt::xss_clean
        $request = $isCleanXss ? $_POST : $_POST;
        if($key === NULL)
            return $request;
        return isset($request[$key]) ? $request[$key] : $default;
    }
    
    /**
     * Get GET data
     * @param string $key - get key from $_GET
     * @param mixed $default - dafeult value
     * @param bool $isCleanXss - is xss_clean (default TRUE)
     * @return mixed - default array
     */
    public static function get($key = NULL, $default = NULL, $isCleanXss = TRUE) {
        // @todo  SecurityExt::xss_clean
        $request = $isCleanXss ? $_GET : $_GET;
        if($key === NULL)
            return $request;
        return isset($request[$key]) ? $request[$key] : $default;
    }
}
