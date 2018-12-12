<?php

require_once('Controller.php');
require_once('../model/User.php');

class UserController extends Controller {
    function __construct() {
        parent::__construct();
    }

    function index() {
        $users = User::all();
        foreach ($users AS $u) {
            if (!empty($u->user_educations())) {
                $u->education = $u->user_educations()->educations()->name;
            } else {
                $u->education = null;
            }
        }

        $tpl = $this->m->loadTemplate('user');
        echo $tpl->render(['users' => $users]);
    }

    function edit() {
        $id = $_REQUEST['id'];
        $user = User::find($id);
        $userEducation = $user->user_educations();
        if (!empty($userEducation))
            $userEducation = $userEducation->educations();

        $educations = Education::all();
        $groups = [1,2,3,4,5,6,7,8];

        $tpl = $this->m->loadTemplate('user.edit');
        echo $tpl->render(compact('user', 'userEducation', 'educations', 'groups'));
    }

    function store() {
        if (!isset($_REQUEST['id']))
            die('For the store function, the ID should exist');

        $id = $_REQUEST['id'];
        $user = User::find($id);
        $data = $_POST;

        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->class = $data['class'];
        $user->date_of_birth = $data['date_of_birth'];

        $user->save();

        $ue = $user->user_educations();
        if (empty($ue)) {
            $ue = new UserEducation();
            $ue->user_id = $id;
        }

        $ue->education_id = $data['education'];
        $ue->save();

        $_SESSION['messages']['success'] = 'Gebruiker met succes opgeslagen';
        return redirect('/?page=user');
    }
}