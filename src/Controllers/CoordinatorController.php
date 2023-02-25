<?php

namespace Src\Controllers;

use Src\Models\Coordinator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CoordinatorController
{
    public static function create()
    {
        $html = Controller::render_template('templates/admin/coordinator.php', [NULL]);

        return new Response($html);
    }

    public static function store(Request $request)
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $phone = $request->request->get('phone');

        if (!empty($name) && !empty($email) && !empty($phone)) {

            $bool = 1;

            $coordinator = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'status' => $bool
            ];
            Coordinator::create($coordinator);
        }

        $html = Controller::render_template('templates/admin/coordinator.php', [NULL]);

        return new Response($html);
    }
}
