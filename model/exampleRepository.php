<?php
session_start();
require_once('../constants.php');
require_once('baseRepository.php');

/*
*   Class inherited from the base repository that performs DB actions related to the ExampleController
*/
class ExampleRepository extends BaseRepository
{   
    /*
    *   Returns every row of table t_table
    */
    public function fetchAllStuff() 
    {
        return fetchAll('t_table');
    }

    /*
    *   Inserts data in the db
    *   Returns 1 if it worked, 0 otherwise
    */
    public function createStuff($a, $b, $c)
    {
        $ok = executeNonQuery('INSERT INTO t_table(a, b, c) VALUES (:a, :b, :c)',       
            array(
                array('a', $a), 
                array('b', $b), 
                array('c', $c))
            );

        if(!$ok) return 0;
        return 1;
    }
}
?>