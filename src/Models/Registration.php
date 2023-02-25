<?php

namespace Src\Models;

class Registration
{
    public static function create($registration)
    {
        $model = new Model();
        $connection = $model->open_database_connection();
        $sql = "INSERT INTO registrations (event_id, user_id) VALUES (:event_id, :user_id)";
        $connection->prepare($sql)->execute($registration);
        $model->close_database_connection($connection);
    }
    public static function get()
    {
        $model = new Model();
        $connection = $model->open_database_connection();
        $sql = "SELECT event_id, user_id FROM registrations";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetchAll();
        $registration = [];
        foreach ($data as $row) {
            $registration[] = $row;
        }
        $model->close_database_connection($connection);
        return $registration;
    }
}
