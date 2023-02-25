<?php

namespace Src\Controllers;

use Src\Models\Event;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    public static function index()
    {
        $events = Event::get();
        $html =  self::render_template('templates/welcome.php', ['events'=>$events]);
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
