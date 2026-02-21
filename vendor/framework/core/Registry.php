<?php
namespace framework\core;


class Registry
{
    use TSingleton;

    public static $objects = [];
    //protected static $instance;

    protected function __construct()
    {
       
        $config = 
        require ROOT."\config\config.php";
        //echo '<pre>';
        //echo "Registry"."<br>";
        //var_dump($config);
        //echo '</pre>';
        foreach ($config['components'] 
            as $name => $component) {
                //echo $name. "|". $component;
                //echo '<pre>';
                //var_dump($config);
                //echo '</pre>';
            self::$objects[$name] = new $component;
            
            }
    }

    
    // for Singleton
   /*  public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        } 
        return self::$instance;
    } */

    public function __get($name)
    {
        if (is_object(self::$objects[$name])) {
            return self::$objects[$name];
        }
    }

    public function __set($name, $object)
    {
        if (!isset(self::$objects[$name])) {
            self::$objects[$name] = new $object;
        }
    }

    public function getList()
    {
        //echo '<pre>';
        //var_dump(self::$objects);
        //echo '</pre>';

    }
}


//$app = Registry::instance();
//$app->getList();
//$app->cache->go();
//$app->test2 = "classes\Test2";
//$app->getList();
//$app->test2->go(); */



