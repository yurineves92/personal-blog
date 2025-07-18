<?php

class Router
{
    private $routes = [];

    public function get($path, $handler)
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post($path, $handler)
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = rtrim($path, '/');
        if (empty($path)) $path = '/';

        if (isset($this->routes[$method][$path])) {
            $this->executeHandler($this->routes[$method][$path]);
            return;
        }

        foreach ($this->routes[$method] ?? [] as $route => $handler) {
            if ($this->matchRoute($route, $path)) {
                $this->executeHandler($handler, $this->extractParams($route, $path));
                return;
            }
        }
        http_response_code(404);
        echo "Página não encontrada";
    }

    private function matchRoute($route, $path)
    {
        $pattern = preg_replace('/\\{[^}]+\\}/', '([^/]+)', $route);
        return preg_match('#^' . $pattern . '$#', $path);
    }

    private function extractParams($route, $path)
    {
        $pattern = preg_replace('/\\{([^}]+)\\}/', '(?P<$1>[^/]+)', $route);
        preg_match('#^' . $pattern . '$#', $path, $matches);
        return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
    }

    private function executeHandler($handler, $params = [])
    {
        list($controller, $method) = explode('@', $handler);
        $controllerInstance = new $controller();
        call_user_func_array([$controllerInstance, $method], $params);
    }
}
