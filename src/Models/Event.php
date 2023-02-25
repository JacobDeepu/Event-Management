<?php

namespace Src\Models;

class Event
{
    public static function create($event)
    {
        $model = new Model();
        $connection = $model->open_database_connection();
        $sql = "INSERT INTO events (name, venue_id, coordinators_id, date, description, status) VALUES (:name, :venue_id, :coordinators_id, :date, :description, :status)";
        $connection->prepare($sql)->execute($event);
        $model->close_database_connection($connection);
    }
    public static function update($event)
    {
        $model = new Model();
        $connection = $model->open_database_connection();
        $sql = "UPDATE events SET name = :name, venue_id = :venue_id, coordinators_id = :coordinators_id, date = :date, description = :description, status = :status WHERE id = :id";
        $connection->prepare($sql)->execute($event);
        $model->close_database_connection($connection);
    }
    public static function get()
    {
        $model = new Model();
        $connection = $model->open_database_connection();
        $sql = "SELECT * FROM events";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetchAll();
        $events = [];
        foreach ($data as $row) {
            $events[] = $row;
        }
        $model->close_database_connection($connection);
        return $events;
    }

    public static function getById($id)
    {
        $model = new Model();
        $connection = $model->open_database_connection();
        $sql = "SELECT * FROM events WHERE id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $id]);
        $event = $statement->fetch();
        $model->close_database_connection($connection);
        return $event;
    }
}
