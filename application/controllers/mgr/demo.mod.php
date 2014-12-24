<?php
/**************************************************

***************************************************/
include(P_ADMIN_MODULES . '/action.abs.php');
class demo_mod extends action {
    function admin_mod() {
        parent :: action();
    }

    function index() {
        $this->_display('demo');
    }
}

