<?php

require_once ('Model.php');
require_once('Education.php');

class UserEducation extends Model
{
    static $table = 'user_educations';

    function __construct() {
        parent::__construct(static::$table);
    }

    function educations() {
        return $this->hasOne('Education', 'education_id', 'id');
    }
}