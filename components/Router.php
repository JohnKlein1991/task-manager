<?php


class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    public function run()
    {
        $uri = $this->getURI();
        foreach ($this->routes as $request => $path){
            // ищем совпадения в строке запроса в списке нашим роутов
            if(preg_match('~'.$request.'~', $uri)){
                $internalPath = preg_replace('~'.$request.'~', $path, $uri);
                $data = explode('/', $internalPath);
                //удаляем нвзвание папки "task-manager"
                array_shift($data);

                $controllerName = ucfirst(array_shift($data).'Controller');
                $actionName = 'action'.ucfirst(array_shift($data));
                $parameters = $data;

                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if(file_exists($controllerFile)){
                    require_once $controllerFile;
                } else {
                    return false;
                }

                $controllerObject = new $controllerName;
                $result = call_user_func_array([$controllerObject, $actionName], $parameters);

                if($result != null){
                    break;
                }
            }
        }
    }

    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])){
            $uri = $_SERVER['REQUEST_URI'];
            return trim($uri, '/');
        }
        return false;
    }
}