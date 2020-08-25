<?php

namespace App;

class View implements Renderable
{
    public $fileName;
    public $data;

    public function __construct(string $fileName, array $data)
    {
        $this->fileName = implode( '/', explode('.', $fileName));
        $this->data = $data;
    }

    public function render()
    {
        $data = $this->data;
        extract($data);
        include_once 'view/' . $this->fileName . '.php';
    }
}
