<?php

namespace Acl\Admin;

/**
 * BillingController
 *
 * @author Valery Shusharin <shusharin_valery@mail.ru>
 */
class BillingController extends \BillingController {
    
    public function __construct() {
    }

    public function show_main($settings = array()) {
        print 'admin';
        print '<br>';

        parent::show_main($settings);
    }

}
