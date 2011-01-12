<?php

/**
 * Query
 * This class represents a single query to the database. Through method
 *   chaining, it makes manipulating the database easier. It should not be used
 *   to create tables or databases; that functionality should be taken care of
 *   by migrations or something like phpmyadmin. There will eventually be
 *   Rails-style migrations.
 * @package MVC
 * @author Andrew Varnerin.
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Query
{
    public $select;
    public $from;
    public $where;
    private $config;
    private $link;
    
    
    /**
     * Query::__construct()
     * Constructs the query and stores necessary data;
     * @param mixed $config The 'db' section of $config
     * @param mixed $link A link to the mysql database
     * @return void
     */
    public function __construct($config, $link)
    {
        $this->config = $config;
        $this->link = $link;
    }
    
    /**
     * Query::select()
     * Builds the SELECT portion of the query to be executed.
     * @param string $what What to select.
     * @return Query This query, to allow for method chaining.
     */
    public function select($what)
    {
        $this->select = $what;
        return $this;
    }
    
    /**
     * Query::from()
     * Builds the FROM portion of the query.
     * @param string $table What table to SELECT from.
     * @return Query This query, to allow for method chaining.
     */
    public function from($table)
    {
        $this->from = $table;
        return $this;
    }
    
    /**
     * Query::where()
     * Builds the WHAT portion of the array.
     * @param string $parameters What the conditions for selection are.
     * @return Query This query, to allow for method chaining.
     */
    public function where($parameters)
    {
        $this->where = $parameters;
        return $this;
    }
    
    /**
     * Query::now()
     * Executes the query immediately and returns an associative array.
     * @return An associative array of the results.
     */
    public function now()
    {
        $query = 'SELECT '.$this->select.' FROM '.$this->from;
        if (isset($this->where))
        {
            $query .= ' WHERE '.$this->where;
        }
        $query .= ';';
        
        $resource = mysql_query($query, $this->link);
        $array = mysql_fetch_assoc($resource);
        //Check to see if there is only one result.
        if (count($array) == 1)
        {
            $array = array(array_pop($array));
            if (count($array) == 1)
            {
                $array = array_pop($array);
            }
        }
        unset($this->select);
        unset($this->from);
        unset($this->where);
        return $array;
    }
}