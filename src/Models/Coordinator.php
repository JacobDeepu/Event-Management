<?php

namespace Src\Models;

class Coordinator
{
    public static function create($coordinator)
    {
        $model = new Model();
        $connection = $model->open_database_connection();
        $sql = "INSERT INTO coordinators (name, email, phone, status) VALUES (:name, :email, :phone, :status)";
        $connection->prepare($sql)->execute($coordinator);
        $model->close_database_connection($connection);
    }
    public static function get()
    {
        $model = new Model();
        $connection = $model->open_database_connection();
        $sql = "SELECT id, name FROM coordinators";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetchAll();
        $coordinators = [];
        foreach ($data as $row) {
            $coordinators[] = $row;
        }
        $model->close_database_connection($connection);
        return $coordinators;
    }
    public static function getById($id)
    {
        $model = new Model();
        $connection = $model->open_database_connection();
        $sql = "SELECT id, name FROM coordinators WHERE id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $id]);
        $venue = $statement->fetch();
        $model->close_database_connection($connection);
        return $venue;
    }
}
