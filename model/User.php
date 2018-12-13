<?php

require_once ('Model.php');
require_once('UserEducation.php');
require_once('Education.php');

class User extends Model
{
    static $table = 'users';

    /**
     * Class constructor
     */
    function __construct() {
        parent::__construct(static::$table);
    }

    public function user_educations() {
        return $this->hasOne('UserEducation', 'id', 'user_id');
    }

}