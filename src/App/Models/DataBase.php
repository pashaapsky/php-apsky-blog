<?php
namespace Models;

use App\Config;
use Illuminate\Database\Capsule\Manager as Capsule;

class DataBase
{
    public function __construct() {
        $capsule = new Capsule;
        $config = Config::getInstance();

        $capsule->addConnection($config->getConfig('dataBase'));

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }
}

