<?php

namespace Src\Controllers;

use Symfony\Component\HttpFoundation\Response;

class Controller
{
    public static function index()
    {
        $html =  self::render_template('templates/welcome.php', [NULL]);
        return new Response($html);
    }

    public static function render_template($path, array $args)
    {
        extract($args);
        ob_start();
        require $path;
        $html = ob_get_clean();
        return $html;
    }
}
