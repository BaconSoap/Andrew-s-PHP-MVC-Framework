<?php
require 'database.php';

/**
 * Model
 * This is the base model that every model MUST extend, in order to gain
 *   database functionality. 
 * @package MVC
 * @author Andrew
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Model
{
    public $load;
    protected $link;
    public static $stat_load;
    private $table_name;
    
    /**
     * Model::__construct()
     * Loads everything necessary for the fun of database interaction.
     * @return void
     */
    public function __construct()
    {
        $this->load = Model::$stat_load;
        Database::$config = $this->load->config['db'];
        $this->link = Database::get_instance();
        $this->table_name = strtolower(substr(get_class($this), 0, -6));
        echo $this->table_name;
    }
    
    /**
     * Model::count()
     * Gets the number of rows that the model's table contains.
     * @return int Row count
     */
    private function count()
    {
        $query = mysql_query('SELECT COUNT(*) FROM `'.$this->table_name.'`;', $this->link);
        return mysql_result($query, 0);
    }
    
    
    
    /**
     * Model::goodbye()
     * A test method.
     * @return void
     */
    public function goodbye()
    {
        echo "there are ".$this->count().' '.$this->table_name;
    }
}