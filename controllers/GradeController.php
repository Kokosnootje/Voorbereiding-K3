<?php

require_once('Controller.php');
require_once('../model/Course.php');
require_once('../model/User.php');
/**
 * Class HomeController
 * The controller to show the initial/ home page
 */
class GradeController extends Controller {

    /**
     * method index
     * shows the home-template (/views/grade.index.mustache)
     */
    function index() {
        $classes = [1,2,3,4,5,6,7,8];
        $courses = Course::all();

        $this->showTemplate('grade_index', compact('classes', 'courses'));
    }

    function addgrade() {
        $class = $_REQUEST['class'];
        $course = $_REQUEST['course'];

        $students = User::where([['class', '=', $class], ['role_id', '=', 1]]);
        dump($students);

    }
}
