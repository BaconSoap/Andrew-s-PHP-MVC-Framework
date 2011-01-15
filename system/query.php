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
    public $config;
    public $options;
    private $link;
    private $table;
    
    
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
    public function now($show_query = false)
    {
        
        $query = 'SELECT '.$this->select.' FROM '.$this->from.' ';
        if (isset($this->where))
        {
            $query .= ' WHERE '.$this->where;
            if(isset($this->options['WHERE']))
            {
                $query .= ' AND '.$this->options['WHERE'];
            }
        } else if(isset($this->options['WHERE']))
        {
            $query .= 'WHERE '.$this->options['WHERE'];
        }
        
        $query .= ' ';
        
        if (isset($this->order_by))
        {
            $query .= ' ORDER BY '.$this->order_by;
            if(isset($this->options['ORDER BY']))
            {
                $query .= ' AND '.$this->options['ORDER BY'];
            }
        } else if(isset($this->options['ORDER BY']))
        {
            $query .= 'ORDER BY '.$this->options['ORDER BY'];
        }

        $query .= ';';
        $resource = mysql_query($query, $this->link);
        $array = $this->mysql_fetch_full_result_array($resource);
        //Reset everything
        unset($this->select);
        unset($this->from);
        unset($this->where);
        unset($this->options);
        
        if ($show_query)
            echo '<br/><b>QUERY:</b> '.$query.'<br/>';
        return $array;
    }

    /**
     * Query::mysql_fetch_full_result_array()
     * Turns a MySQL result into an array.
     * @param mysql_resource $result
     * @return array
     */
    private function mysql_fetch_full_result_array($result)
    {
        $table_result=array();
        $r=0;
        while($row = mysql_fetch_assoc($result)){
            $arr_row=array();
            $c=0;
            while ($c < mysql_num_fields($result)) {        
                $col = mysql_fetch_field($result, $c);    
                $arr_row[$col -> name] = $row[$col -> name];            
                $c++;
            }    
            $table_result[$r] = $arr_row;
            $r++;
        }    
        return $table_result;
    }

    
    /**
     * Query::insert()
     * Inserts an associative array into the table.
     * @example $array = array(cheese => 'swiss', price=> 5.5);
     * @param mixed $table The table to insert into
     * @param mixed $values The associative array of values
     * @return True if the insert was successful; false otherwise.
     */
    function insert($table, $data)
    {
        //Checks whether or not to timestamp things.
        if($this->config['timestamp_records'])
        {
            $data['created_at'] = date('Y-m-d H:i:s', time());
            $data['updated_at'] = $data['created_at'];
        }
        
        $db_link = $this->link;
        $columns = array_keys($data);
    
        $values = array_values($data);
        
        // Protect the database
        $values_number = count($values);
        for ($i = 0; $i < $values_number; $i++)
        {
            $value = $values[$i];
            if (!is_numeric($value))    { $value = "'" . mysql_real_escape_string($value, $db_link) . "'"; }
            $values[$i] = $value;
        }
         
        $sql = "INSERT INTO $table ";
        
        // create comma-separated string of column names, enclosed in parentheses
        $sql .= "(".join(", ", $columns).")";
        $sql .= " values ";
    
        // create comma-separated string of values, enclosed in parentheses
        $sql .= "(".join(", ", $values).")";
        $result = mysql_query($sql) OR die("<br />\n<span style=\"color:red\">Query: $sql UNsuccessful :</span> ".mysql_error()."\n<br />");
        return ($result) ? true : false;
    }

}