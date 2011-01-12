<?php
require 'database.php';
require 'query.php';

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
    public $query;
    
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
     * Model::select()
     * Begins a query. Populates the query's FROM portion automagically.
     * @param $what What to select.
     * @return Query The query being constructed. This allows method chaining.
     */
    public function select($what)
    {
        $this->query = new Query($this->load->config['db'], $this->link);
        return $this->query->select($what)->from($this->table_name);
    }
}