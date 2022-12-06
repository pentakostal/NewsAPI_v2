<?php

namespace App\Services;

use App\Redirect;
use Doctrine\DBAL\DriverManager;

require_once 'vendor/autoload.php';

class LogInService
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

    public function execute(LogInServiceRequest $request): bool
    {
        $logInUser = $request;

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue("email", $logInUser->getEmail());
        $resultSet = $stmt->executeQuery();
        $users = $resultSet->fetchAllAssociative();
        echo "<pre>";

        if ($users) {
            if (password_verify($logInUser->getPassword(), $users[0]["password"])) {
                var_dump("log in");
                return true;
            }
        }
        var_dump("something wrong");
        return false;
    }
}