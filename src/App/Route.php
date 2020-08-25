<?php

namespace App;

class Route
{
    private $method;
    private $path;
    private $callback;

    public function __construct($method, $path, $callback)
    {
        if (mb_strlen($path) !== 1) {
            if ($path[0] !== '/' && mb_strlen($path) !== 1) {
                $path = '/' . $path;
            }

            if ($path[mb_strlen($path) - 1] === '/') {
                $path = substr($path, 0, mb_strlen($path) - 1);
            }
        }

        $this->method = $method;    //http запрос
        $this->path = $path;        // '/'
        $this->callback = $callback;
    }

    private function prepareCallback($callback, $params) {
        if ((gettype($callback) === 'string') && (stristr($callback, "Controller") !== false)) {
            $methodRequest = substr(stristr($callback, '@'), 1); //@about -> about
            $controllerName = substr($callback, 0, mb_strrpos($callback, '@'));

            if (method_exists(new $controllerName(), $methodRequest)) {
                $result = new $controllerName();

                if (!empty($params)) {
                    $result = $result->$methodRequest(...$params);
                } else {
                    $result = $result->$methodRequest();
                }

                $this->callback = $result;
            }
        } elseif (gettype($callback) === 'object') {
            if (!empty($params)) {
                $this->callback = call_user_func_array($callback, $params);
            } else {
                $this->callback = $callback();
            }
        }
    }

    public function getPath() {
        return $this->path;
    }

    public function match($method, $uri): bool {
        if (preg_match( '/^' . str_replace([ '*' , '/' ], [ '\w+' , '\/' ], $this->getPath()) . '$/' , $uri) && $this->method === $method) {
            return true;
        } else {
            return false;
        }
    }

    public function run($uri) {
        $params = [];

        foreach (explode('/', $this->path) as $id => $item) {
            if ($item === '*') {
                $params[] = explode('/', $uri)[$id];
            }
        }

        $this->prepareCallback($this->callback, $params);

        if ($this->callback instanceof Renderable) {
            return $this->callback->render();

        } elseif (gettype($this->callback === 'string')) {
            echo $this->callback;
            return true;
        } else {
            return $this->callback;
        }
    }
}
