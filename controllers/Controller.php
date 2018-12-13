<?php

/**
 * Class Controller
 * Base class for all the controllers, not advisable to edit this file...
 */
class Controller
{
    var $m;
    var $viewsFolder = '../views';
    var $messages;

    /**
     * Controller constructor.
     */
    function __construct() {
        $msg = null;
        if (isset($_SESSION['messages']) && is_array($_SESSION['messages']) && count($_SESSION['messages']) > 0)
            $this->messages = $_SESSION['messages'];

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

    function showTemplate($file, $vars = []) {
        $fileLocations = explode('.', $file);
        $viewFile = $this->viewsFolder;
        foreach ($fileLocations AS $loc) {
            $viewFile .= '/'.$loc;
        }
        $viewFile .= '.phtml';

        foreach ($vars AS $key => $value)
            $$key = $value;

        $messages = $this->messages;

        if (file_exists($viewFile))
            require_once($viewFile);
        else
            die('The chosen view does not exist');
    }

}
