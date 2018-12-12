<?php

/**
 * Class DatabaseSettings basic class to store mysql-settings.
 */
class DatabaseSettings
{
    var $settings;

    /**
     * @return array
     */
    function getSettings()
    {
        $settings = [];
        // Database variables
        // Host name
        $settings['dbhost'] = 'localhost';
        // Database name
        $settings['dbname'] = 'tcrkt3';
        // Username
        $settings['dbusername'] = 'tcrkt3';
        // Password
        $settings['dbpassword'] = 'tcrkt3';

        return $settings;
    }
}