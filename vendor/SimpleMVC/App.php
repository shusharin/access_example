<?php

namespace SimpleMVC;

/**
 * App
 *
 * @todo \SimpleMVC\Exception
 * @author Valery Shusharin <shusharin_valery@mail.ru>
 */
class App {

    /**
     * instance (singleton)
     * @var \SimpleMVC\App 
     */
    private static $instance;

    /**
     *
     * @var \SimpleMVC\Request 
     */
    private $request;

    /**
     *
     * @var \SimpleMVC\Config 
     */
    private $config;

    /**
     * config settings
     * @var string 
     */
    private $app_path, $controllers_dir;

    private function __construct() {
        $this->request = Request::instance();
        $this->config = new Config();
        // get system config
        $sys_conf = $this->config->system;

        // define config params
        $this->app_path = isset($sys_conf['app_path']) ? $sys_conf['app_path'] : '';
        $this->controllers_dir = isset($sys_conf['controllers_dir']) ? $sys_conf['controllers_dir'] : '';
        $controllers_suffix = isset($sys_conf['controllers_suffix']) ? $sys_conf['controllers_suffix'] : '';

        // load base controllers
        if (isset($sys_conf['base_controllers']) && is_array($sys_conf['base_controllers'])) {
            foreach ($sys_conf['base_controllers'] as $base_controller)
                $this->load($this->app_path . $this->controllers_dir . DIRECTORY_SEPARATOR . $base_controller . $controllers_suffix);
        }
    }

    /**
     * instance Request
     * @return \SimpleMVC\App
     */
    public static function instance() {
        if (!self::$instance)
            self::$instance = new App ();

        return self::$instance;
    }

    /**
     * start app
     * @throws \Exception
     */
    public function start() {
        // load class
        if (!$this->load($this->app_path . $this->controllers_dir . DIRECTORY_SEPARATOR . ($controller_name = $this->request->get_controller())))
            throw new \Exception('File not found!', 404);

        $c = new $controller_name();

        if (!method_exists($c, $this->request->get_action()))
            throw new \Exception('Page not found!', 404);

        call_user_method($this->request->get_action(), $c);
    }

    /**
     * load class
     * @param string $path - path without ext
     * @throws \Exception
     * @return boolean
     */
    private function load($path) {        
        if (!file_exists($path . '.php'))
            return FALSE;
        return require_once ($path . '.php');
    }

    /**
     * load controller
     * @param string $controller_name - name of controller
     * @param string $controllers_dir - dirname for controllers
     * @param string $app_path - path to app
     * @return boolean
     */
    public function load_controller($controller_name, $controllers_dir = NULL, $app_path = NULL) {
        $controllers_dir = is_null($controllers_dir) ? $this->controllers_dir : $controllers_dir;
        $app_path = is_null($app_path) ? $this->app_path : $app_path;
        return $this->load($app_path . $controllers_dir . DIRECTORY_SEPARATOR . $controller_name);
    }

}
