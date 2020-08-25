<?php
namespace App;

use function helpers\array_get;

class Config
{
    private static $configs;

    protected function __construct() {
        self::$configs['cfg'] = include_once $_SERVER['DOCUMENT_ROOT'] . '/configs/config.php';
    }

    protected function __clone() { }
    public function __wakeup() {}

    public static function getInstance(): Config
    {
        $cls = static::class;

        if (!isset(self::$configs[$cls])) {
            self::$configs[$cls] = new static;
        }

        return self::$configs[$cls];
    }

    public function getConfig($key) {
        return array_get(self::$configs['cfg'], $key);
    }
}
