<?php

require_once ('Model.php');
require_once('Education.php');

class UserEducation extends Model
{
    static $table = 'user_educations';

    /**
     * Connection to the education
     * @return mixed
     */
    function educations() {
        return $this->hasOne('Education', 'education_id', 'id');
    }

    function users() {
        return $this->hasOne('User', 'user_id', 'id');
    }
}