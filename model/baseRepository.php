<?php
require_once('../constants.php');
require_once(ROOT_DIR.'/db/dbFunctions.php');

/*
*   Base repository: make your repos inherit from this class
*/
abstract class BaseRepository
{
    /*
    *   SpecialData enum
    */
    abstract class SpecialData
    {
        const Error = 0;
        const Success = 1;
    }

    private $ERROR_NAME = 'DQAa5piHoPDsCS4sWy0y';   // Error data name
    private $SUCCES_NAME = 'g6FqQBun8v7QC1AZp7NZ';  // Success data name

    private static $repository = array();  // Data of the repo set by the controller and gotten from the view

    /*
    *   Sets a data to the array
    */
    public function setData($name, $data)
    {
        BaseRepository::$repository[$name] = $data;
    }

    /*
    *   Return true if the data is found, false otherwise
    */
    public function hasData($name)
    {
        return (isset(BaseRepository::$repository[$name]));
    }

    /*
    *   Gets a data by its name, null if not found
    */
    public function getData($name)
    {
        if($this->hasData($name))
            return BaseRepository::$repository[$name];
        return null;
    }

    /*
    *   Sets a data of type $type to the array
    */
    public function setSpecialData($type, $text)
    {
        switch($type)
        {
            case BaseRepository::SpecialData::Error:
                BaseRepository::$repository[$ERROR_NAME] = $text;
                break;
            case SpecialData::Success:
                BaseRepository::$repository[$SUCCESS_NAME] = $text;
                break;
            default:
                break;
        }
    }

    /*
    *   Return true if the data is found, false otherwise
    */
    public function hasSpecialData($type)
    {
        switch($type)
        {
            case BaseRepository::SpecialData::Error:
                return $this->hasData($ERROR_NAME);
            case BaseRepository::SpecialData::Success:
                return $this->hasData($SUCCESS_NAME);
            default:
                return null;
        }
    }

    /*
    *   Gets a data by its type, null if not found
    */
    public function getSpecialData($type)
    {
        switch($type)
        {
            case BaseRepository::SpecialData::Error:
                return $this->getData($ERROR_NAME);
            case BaseRepository::SpecialData::Success:
                return $this->getData($SUCCESS_NAME);
            default:
                return null;
        }
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