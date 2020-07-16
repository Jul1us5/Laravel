<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataBaseController extends Controller
{
    public function create()
    {

        $user = 'root';
        $pass = 'root';
        $dsn = "mysql:host=localhost;dbname=garage;charset=utf8mb4"; // CHANGE DATABASE NAME | CONTROLER
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $pdo = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        try {
            // sql to create table
            $sql = "CREATE TABLE IF NOT EXISTS owners (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(64) NOT NULL,
                surname VARCHAR(64) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
            // use exec() because no results are returned
            $pdo->exec($sql);
            // echo “Table MyGuests created successfully“;
        } catch (\PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

        try {
            // sql to create table
            $sql = "CREATE TABLE IF NOT EXISTS cars (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                isbn VARCHAR(20) NOT NULL,
                pages TINYINT(4) UNSIGNED,
                about TEXT,
                owners_id INT(11) UNSIGNED NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (owners_id) REFERENCES owners(id)
                )";
            // use exec() because no results are returned
            $pdo->exec($sql);
            // echo “Table MyGuests created successfully“;
        } catch (\PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}
