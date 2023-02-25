<?php

namespace Src\Models;

class Venue
{
    public static function create($venue)
    {
        $model = new Model();
        $connection = $model->open_database_connection();
        $sql = "INSERT INTO venues (name, nearby, status) VALUES (:name, :nearby, :status)";
        $connection->prepare($sql)->execute($venue);
        $model->close_database_connection($connection);
    }
    public static function get()
    {
        $model = new Model();
        $connection = $model->open_database_connection();
        $sql = "SELECT id, name FROM venues";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetchAll();
        $venues = [];
        foreach ($data as $row) {
            $venues[] = $row;
        }
        $model->close_database_connection($connection);
        return $venues;
    }
    public static function getById($id)
    {
        $model = new Model();
        $connection = $model->open_database_connection();
        $sql = "SELECT id, name FROM venues WHERE id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $id]);
        $venue = $statement->fetch();
        $model->close_database_connection($connection);
        return $venue;
    }
}
