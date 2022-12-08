<?php

namespace App\Services;

use Doctrine\DBAL\DriverManager;

require_once 'vendor/autoload.php';

class ChangeDataService
{
    private $connection;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'driver' => $_ENV['DB_DRIVER'],
        ];

        $this->connection = DriverManager::getConnection($connectionParams);
    }

    public function execute(ChangeDataServiceRequest $request)
    {
        $newUser = $request;

        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue("id", $_SESSION['userId']);
        $resultSet = $stmt->executeQuery();
        $users = $resultSet->fetchAllAssociative();

        echo "<pre>";
        var_dump($users);
    }
}