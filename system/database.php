<?php 

/**
 * Database
 * The database connection class. Use Database::get_instance() to grab the link
 *   identifier. This is currently for mysql only.
 * @package MVC
 * @author Andrew Varnerin
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Database
{
    public static $config;
    public static $instance;
    
    /**
     * Database::get_instance()
     * Gets the database link.
     * @return mysql_link Link identifier
     */
    static function get_instance()
    {
        if(!isset(Database::$instance))
        {
            Database::$instance = mysql_connect(Database::$config['server'], Database::$config['username'], Database::$config['password']);
        }
        
        if (!mysql_select_db(Database::$config['database'], Database::$instance))
        {
            echo 'Error connecting to database';
        }
    return Database::$instance;
    }
}