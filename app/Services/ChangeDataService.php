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
        $userData = $request;

        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue("id", $_SESSION["userId"]);
        $resultSet = $stmt->executeQuery();
        $users = $resultSet->fetchAllAssociative();

        if (password_verify($userData->getPasswordConfirmation(), $users[0]["password"])) {
            if ($userData->getNameNew() != null) {
                $this->connection->update('users', ['name' => $userData->getNameNew()], ['id' => $_SESSION['userId']]);
            }

            if ($userData->getEmailNew() != null) {
                $this->connection->update('users', ['email' => $userData->getEmailNew()], ['id' => $_SESSION['userId']]);
            }

            if ($userData->getPasswordNew() != null && $userData->getPasswordNew() == $userData->getPasswordRepeatNew()) {
                $newPasswordHash = password_hash($userData->getPasswordNew(), PASSWORD_DEFAULT);
                $this->connection->update('users', ['password' => $newPasswordHash], ['id' => $_SESSION['userId']]);
            }

            echo "<pre>";
            var_dump("User data update");
        }
    }
}