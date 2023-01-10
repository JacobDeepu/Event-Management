<?php

namespace Src\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Src\Models\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthController
{
    public static function index()
    {
        $html = Controller::render_template('templates/auth/login.php', [NULL]);

        return new Response($html);
    }

    public static function login(Request $request)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $data = [];
        if (!empty($email) && !empty($password)) {
            $data = User::get_user($email, $password);
        }
        $session = new Session();
        $session->start();
        if (count($data) && password_verify($password, $data['password'])) {
            $session->set('id', $data['id']);
            $session->set('name', $data['name']);
            return new RedirectResponse('/');
        } else {
            $flashes = $session->getFlashBag();
            $flashes->add('error', 'Failed to login');
            $html = Controller::render_template('templates/auth/login.php', ['flashes' => $flashes]);
            return new Response($html);
        }
    }

    public static function register()
    {
        $html = Controller::render_template('templates/auth/register.php', [NULL]);

        return new Response($html);
    }

    public static function store(Request $request)
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $phone = $request->request->get('phone');
        $password = $request->request->get('password');

        if (!empty($name) && !empty($email) && !empty($phone) && !empty($password)) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $user = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password_hash,
                'created_at' => date("Y-m-d h:i:s")
            ];
            User::create($user);
        }

        return new RedirectResponse('/login/');;
    }
}
