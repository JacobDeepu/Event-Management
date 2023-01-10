<?php

namespace Src\Models;

class User
{
    public static function create($user)
    {
        $model = new Model();
        $connection = $model->open_database_connection();

        $sql = "INSERT INTO users (name, email, phone, password, created_at) VALUES (:name, :email, :phone, :password, :created_at)";
        $connection->prepare($sql)->execute($user);

        $model->close_database_connection($connection);

        return "User Created";
    }

    public static function get_user($email)
    {
        $model = new Model();
        $connection = $model->open_database_connection();

        $sql = "SELECT id, name, password FROM users WHERE email=:email";
        $statement = $connection->prepare($sql);
        $statement->execute(['email' => $email]);
        $data = $statement->fetch();

        $model->close_database_connection($connection);

        return $data;
    }
}
