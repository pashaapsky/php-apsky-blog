<?php
namespace App;

use Exception;
use Models\DataBase;

class Application
{
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
        $this->initialize();
    }

    public function initialize() {
        new DataBase();
    }

    public function renderException($exception)
    {
        if ($exception instanceof Renderable) {
            $exception->render();
        } else {
          $code = $exception->getCode();

          if ($code === 0) {
              $code = 500;
          }

          echo 'Возникла ошибка с кодом ' . $code  . ' ' . $exception->getMessage();
        }
    }

    public function run()
    {
        try {
            $this->router->dispatch();
        } catch (Exception $e) {
            $this->renderException($e);
        }
    }
}