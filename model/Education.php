<?php

require_once ('Model.php');

class Education extends Model
{
    static $table = 'educations';

    function __construct() {
        parent::__construct(static::$table);
    }
}