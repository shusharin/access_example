<?php

/**
 * BillingController
 *
 * @author Valery Shusharin <shusharin_valery@mail.ru>
 */
class BillingController extends BaseController {

    public function __construct() {
        parent::__construct();

        $role = 'admin';

        if ($role) {
            if ($this->_app->load_controller(__CLASS__, 'acl' . DIRECTORY_SEPARATOR . $role)) {
                $c = '\Acl\\' . ucfirst($role) . '\\' . __CLASS__;
                $c = new $c();
                if (method_exists($c, $a = $this->_request->get_action())){
                    $c->$a();
                    exit();
                }
                    
            }
        }
    }

    public function show_main($settings = []) {

        print 'general';
    }
    
    public function test($settings = []) {

        print 'general';
    }
    
    

}
