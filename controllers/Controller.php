<?php

/**
 * Class Controller
 * Base class for all the controllers, not advisable to edit this file...
 */
class Controller
{
    var $m;

    /**
     * Controller constructor.
     */
    function __construct() {
        require_once('../mustache/src/Mustache/Autoloader.php');
        Mustache_Autoloader::register();

        $msg = null;
        if (isset($_SESSION['messages']) && is_array($_SESSION['messages']) && count($_SESSION['messages']) > 0)
            $msg = $_SESSION['messages'];

        $this->m = new Mustache_Engine(array(
            'helpers' => ['messages' => $msg],
            'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/../views'),
        ));

        $_SESSION['messages'] = null;

        if (!isset($_REQUEST['action']))
            $action = 'index';
        else
            $action = $_REQUEST['action'];

        if (method_exists($this, $action)) {
            $this->{$action}();
        } else {
            die('The chosen method, <strong>'.$action.'</strong> does not exist in the controller');
        }
    }
}
