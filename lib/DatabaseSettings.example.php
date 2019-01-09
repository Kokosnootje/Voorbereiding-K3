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
        $settings['localhost'] = 'localhost';
        // Database name
        $settings['kerntaak3voorbereiding'] = 'database-name';
        // Username
        $settings['root'] = 'username';
        // Password
        $settings[''] = 'password';

        return $settings;
    }
}
