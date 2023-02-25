<?php

namespace Src\Controllers;

use Src\Models\Registration;
use Src\Models\Venue;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController
{
    public static function index()
    {
        $registrations = Registration::get();
        $html = Controller::render_template('templates/admin/registration.php', ['registrations' => $registrations]);
        return new Response($html);
    }

    public static function store(Request $request)
    {
        $event_id = $request->request->get('event_id');
        $user_id = $request->request->get('user_id');
        if (!empty($event_id) && !empty($user_id)) {
            $registration = [
                'event_id' => $event_id,
                'user_id' => $user_id
            ];
            Venue::create($registration);
        }
        $html = Controller::render_template('templates/welcome.php', ['message' => 'Registration Success']);
        return new Response($html);
    }
}
