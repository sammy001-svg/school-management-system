<?php
class Router {
    private array $routes = [];

    public function get(string $path, array $handler): void {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array $handler): void {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(): void {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $base   = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        $path   = '/' . ltrim(substr($uri, strlen($base)), '/');
        $path   = $path === '' ? '/' : $path;

        foreach ($this->routes[$method] ?? [] as $route => $handler) {
            $pattern = preg_replace('#\{[^}]+\}#', '([^/]+)', $route);
            $pattern = '#^' . $pattern . '$#';
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches);
                [$controllerClass, $action] = $handler;
                if (!class_exists($controllerClass)) {
                    $cfile = dirname(__DIR__) . "/app/Controllers/{$controllerClass}.php";
                    if (file_exists($cfile)) {
                        require_once $cfile;
                    }
                }
                $ctrl = new $controllerClass();
                call_user_func_array([$ctrl, $action], $matches);
                return;
            }
        }

        http_response_code(404);
        require dirname(__DIR__) . '/app/Views/layouts/404.php';
    }
}
