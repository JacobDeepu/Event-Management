<?php

namespace Src\Controllers;

use Src\Models\Coordinator;
use Src\Models\Event;
use Src\Models\Venue;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class EventController
{
    public static function index()
    {
        $events = Event::get();
        $html = Controller::render_template('templates/event/index.php', ['events' => $events]);
        return new Response($html);
    }

    public static function create()
    {
        $venues = Venue::get();
        $coordinators = Coordinator::get();
        $html = Controller::render_template('templates/event/create.php', ['venues' => $venues, 'coordinators' => $coordinators]);
        return new Response($html);
    }

    public static function store(Request $request)
    {
        $name = $request->request->get('name');
        $venue_id = $request->request->get('venue_id');
        $coordinators_id = $request->request->get('coordinator_id');
        $date = $request->request->get('date');
        $description = $request->request->get('description');

        if (!empty($name) && !empty($venue_id) && !empty($coordinators_id) && !empty($date)) {

            $bool = 1;

            $event = [
                'name' => $name,
                'venue_id' => $venue_id,
                'coordinators_id' => $coordinators_id,
                'date' => $date,
                'description' => $description,
                'status' => $bool
            ];
            Event::create($event);
        }

        return new RedirectResponse('/admin/events/');
    }

    public static function update(Request $request)
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $name = $request->request->get('name');
        $venue_id = $request->request->get('venue_id');
        $coordinators_id = $request->request->get('coordinator_id');
        $date = $request->request->get('date');
        $description = $request->request->get('description');

        if (!empty($name) && !empty($venue_id) && !empty($coordinators_id) && !empty($date)) {

            $bool = 1;

            $event = [
                'id' => $id,
                'name' => $name,
                'venue_id' => $venue_id,
                'coordinators_id' => $coordinators_id,
                'date' => $date,
                'description' => $description,
                'status' => $bool
            ];
            Event::update($event);
        }

        return new RedirectResponse('/admin/events/');
    }

    public static function show()
    {
        $venues = Venue::get();
        $coordinators = Coordinator::get();
        if (isset($_GET['id'])) {
            $event = Event::getById($_GET['id']);
        }
        $html = Controller::render_template('templates/event/update.php', ['event' => $event, 'venues' => $venues, 'coordinators' => $coordinators]);
        return new Response($html);
    }
}
