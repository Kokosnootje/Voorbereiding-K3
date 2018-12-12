<?php

require_once('Controller.php');

/**
 * Class HomeController
 * The controller to show the initial/ home page
 */
class HomeController extends Controller {

    /**
     * method index
     * shows the home-template (/views/home.mustache)
     */
    function index() {
        $tpl = $this->m->loadTemplate('home');
        echo $tpl->render(['planet' => 'world']);
    }
}
