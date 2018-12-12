<?php

require_once('Controller.php');

class HomeController extends Controller {
    function __construct() {
        parent::__construct();
    }

    function index() {
        $tpl = $this->m->loadTemplate('home');
        echo $tpl->render(['planet' => 'world']);
    }
}
