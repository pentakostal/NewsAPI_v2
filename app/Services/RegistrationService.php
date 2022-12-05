<?php

namespace App\Services;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

require_once 'vendor/autoload.php';

class RegistrationService
{
    private $connection;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => 'news_api',
            'user' => 'root',
            'password' => 'pentakostal',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];

        $this->connection = DriverManager::getConnection($connectionParams);


    }

    public function execute(RegistrationServiceRequest $request)
    {
        $newUser = $request;

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue("email", $newUser->getEmail());
        $resultSet = $stmt->executeQuery();
        $users = $resultSet->fetchAllAssociative();

        if ($users == null) {
            $this->connection->insert('users', [
                "name" => $newUser->getName(),
                "email" => $newUser->getEmail(),
                "password" => $newUser->getPassword()
            ]);
            echo "signup ok";
        } else {
            echo "email exists";
        }
    }
}