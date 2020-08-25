<?php

namespace App;

class NotFoundException extends HttpException implements Renderable
{
    public function render()
    {
        http_response_code(400);
        include_once $_SERVER["DOCUMENT_ROOT"] . '/view/404error.php';
    }
}