<?php

namespace Zam0k\PhpMvc\Controller\Video;

use Zam0k\PhpMvc\Controller\Controller;

class Error404Controller implements Controller
{
    public function processaRequisicao()
    {
        http_response_code(404);
    }
}