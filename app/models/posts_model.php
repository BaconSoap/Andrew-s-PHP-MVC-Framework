<?php

class Posts_Model extends Model
{
    public function hello()
    {
        echo '<br/>Hello from a model<br/>';
    }
    
    /**
     * Posts_Model::recent()
     * An example scope. Fetches posts within a week and orders them by date,
     *   descending.
     * @return $this The current posts model. Allows method chaining
     */
    public function recent()
    {
        $this->options['WHERE'] = 'created_at >= ADDDATE( NOW( ) , INTERVAL -1 WEEK )';
        $this->options['ORDER BY'] = 'created_at DESC';
        return $this;
    }
}