<?php
require_once('../constants.php');
require_once('baseController.php');
require_once(ROOT_DIR.'/model/exampleRepository.php');

/*
*   Class inherited from BaseController
*/
class ExampleController extends BaseController
{
    private $repo = new ExampleRepository();    // The repository

    /*
    *   Defining the actions of this controller
    */
    public function init()
    {
        $this->addAction('doStuff', 'performThingA');
        $this->addAction('doMoreStuff', 'performThingB');
    }

      /********************/
     /* Action functions */
    /********************/

    /*
    *   Action method A
    */
    protected static function performThingA()
    {
        // Get the GET parameter "param1" and "param2"
        $p1 = (new self)->getParam('param1');
        $p2 = (new self)->getParam('param2');

        if($p1 === null || $p2 === null)
        {
            // Error

            // Example error handling:
            $this->repo->addData('error', 'One or more parameters not found.');
            (new self)->displayView('exampleView');
        }

        // Use the repository to do stuff in the database
        if(!$this->repo->createStuff($p1, $p2, 0))
        {
            // Error
        }

        // Use the repository to add data to our next view
        $this->repo->addData('stuff', array($p1, $p2));

        // Display a view
        (new self)->displayView('exampleView');
    }

    /*
    *   Action method B
    */
    protected static function performThingB()
    {
        // ...
    }
}

$controller = new ExampleController();
$controller->process(ExampleController::class);

?>