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
     * The array of options to pass into the query. Allows for named scopes.
     * @var array
     */
    public $options;
    
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
        $this->query->options = $this->options;
        return $this->query->select($what)->from($this->table_name);
    }
    
    /**
     * Model::insert()
     * Inserts a record into the database, with an associative array as the data.
     * @param mixed $values
     * @return boolean True or false, depending on the outcome.
     */
    public function insert($values)
    {
        $this->query = new Query($this->load->config['db'], $this->link);
        $this->query->config['timestamp_records'] = $this->load->config['timestamp_records'];
        return $this->query->insert($this->table_name, $values);
    }
    
    /**
     * Model::run_query()
     * Directly runs a query against the database.
     * @param mixed $query The query to run.
     * @return An associative array of the results of the query.
     */
    public function run_query($query)
    {
        $result = mysql_query($query, $this->link);
        return $result;
    }
    
    
}