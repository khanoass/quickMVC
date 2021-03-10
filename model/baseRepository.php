<?php
require_once('../constants.php');
require_once(ROOT_DIR.'/db/dbFunctions.php');

/*
*   Base repository: make your repos inherit from this class
*/
abstract class BaseRepository
{
    private static $repository = array();  // Data of the repo set by the controller and gotten from the view

    /*
    *   Clears the repository array
    */
    public function clearData()
    {
        BaseRepository::$repository = array();
    }

    /*
    *   Return true if the data is found, false otherwise
    */
    public function hasData($name)
    {
        return (isset(BaseRepository::$repository[$name]));
    }

    /*
    *   Adds a data to the array
    *   This method is to be used by a controller
    */
    public function addData($name, $data)
    {
        BaseRepository::$repository[$name] = $data;
    }

    /*
    *   Gets a data by its name
    *   This method is to be used by a view
    */
    public function getData($name)
    {
        if($this->hasData($name))
            return BaseRepository::$repository[$name];
        return null;
    }

    /*
    *   Fetches all records of a table
    */
    protected function fetchAll($table)
    {
        $r =  executeQuery('SELECT * FROM '.$table);
        if($r) return $r;
        return null;
    }

    /*
    *   Fetches a records of a table that matches an id, return null if not found
    */
    protected function fetchFromId($table, $id)
    {
        $r = executeQuery('SELECT * FROM '.$table.' WHERE id=:id', array(array('id', $id)));
        if($r) return $r;
        return null;
    }
}

?>