<?php

namespace Src\Controllers;

use Src\Models\Venue;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class VenueController
{
    public static function create()
    {
        $html = Controller::render_template('templates/admin/venue.php', [NULL]);
        return new Response($html);
    }

    public static function store(Request $request)
    {
        $name = $request->request->get('name');
        $nearby = $request->request->get('nearby');
        if (!empty($name) && !empty($nearby)) {
            $bool = 1;
            $venue = [
                'name' => $name,
                'nearby' => $nearby,
                'status' => $bool
            ];
            Venue::create($venue);
        }
        $html = Controller::render_template('templates/admin/venue.php', [NULL]);
        return new Response($html);
    }
}
