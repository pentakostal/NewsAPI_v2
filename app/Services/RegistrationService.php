<?php

namespace App\Services;

use Doctrine\DBAL\DriverManager;

require_once 'vendor/autoload.php';

class RegistrationService
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
                "password" => password_hash($newUser->getPassword(), PASSWORD_DEFAULT)
            ]);
            var_dump("signup ok");
        } else {
            var_dump("email exists");
        }
    }
}