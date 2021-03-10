<?php
require_once('../constants.php');

/*
*   Base controller: make your controllers inherit from this class.
*
*   Example:
*   --------
*   class ExampleController extends BaseController
*   {
*       ...
*   }
*/
abstract class BaseController
{
    private $actions = array(); // Actions defined from a controller
    private static $params = array();  // Params gotten from GET when a controller is loaded

    /*
    *   Override this method to put your actions with the protected function addAction.
    *
    *   Example:
    *   --------
    *   public function init()
    *   {
    *       $this->addAction('doStuff', 'performThingA');
    *       $this->addAction('doMoreStuff', 'PerformThingB');
    *   }
    *
    *   You can then create /!\ STATIC /!\  methods with the names "performThingA" and "performThingB" to actually do your stuff.
    *   Your action can then be called like this: "../../myCustomController.php?action=doStuff" and the "performThingA" method will
    *   automatically be executed.
    *
    *   Example:
    *   --------
    *   protected static function performThingA()
    *   {
    *       ...
    *   }
    */
    abstract protected function init();

    /*
    *   Adds an action to the possible actions
    *   $name corresponds to the action name and $method to the method to be called when this action is requested.
    */
    protected function addAction($name, $method)
    {
        $this->actions[$name] = $method;
    }

    /*
    *   Returns a parameter value based on its name, null if it doesn't exist.
    *   You can pass parameters to any controller like so: "../../myCustomController.php?action=doStuff&param1=0&param2=5"
    *
    *   The parameters "param1" and "param2" can then be retrieved very handily in your action methods.
    *   
    *   Example:
    *   --------
    *   protected static function performThingA()
    *   {
    *       ...
    *       $p1 = $this->getParam('param1');               // $p1 is 0
    *       $p2 = $this->getParam('param2');               // $p2 is 5
    *       ...
    *   }
    */
    protected function getParam($name)
    {
        if(isset(BaseController::$params[$name]))
            return BaseController::$params[$name];
        return null;
    }

    /*
    *   Displays a view. Basically a redirect.
    */
    protected function displayView($view)
    {
        $h = 'Location: '.ROOT_DIR.'/view/'.$view.'.php';
        header($h);
    }

    /*
    *   Executes another controllers action.
    */
    protected function execControllerAction($controllerFilename, $action)
    {
        $h = 'Location: '.ROOT_DIR.'/controller/'.$controllerFilename.'.php?action='.$action;
        header($h);
    }

    /*
    *   Function that executes the function associated to the $action name in the $actions array.
    */
    private function evaluate($action, $controllerName)
    {
        if(array_key_exists($action, $this->actions))
            call_user_func(array($controllerName, $this->actions[$action]));
        else
            return 0;
        return 1;
    }

    /*
    *   Fetches all the parameters gotten through GET.
    */
    private function fetchParams()
    {
        foreach(array_keys($_GET) as $param)
        {
            if($param !== 'action')
                BaseController::$params[$param] = $_GET[$param];
        }
    }

    /*
    *   Inits the controller, fetches the parameters and executes 
    *   the action gotten through GET.
    *
    *   This method must be called in your controller file, after your class definition.
    *
    *   Example:
    *   --------
    *   class ExampleController extends BaseController
    *   {
    *       ...
    *   }
    *
    *   $controller = new ExampleController();
    *   $controller->process(ExampleController::class);
    */
    public function process($controllerName)
    {
        $this->init();
        $this->fetchParams();

        if($this->evaluate($_GET['action'], $controllerName) == 0)
            echo 'Bad action name';
    }
}

?>