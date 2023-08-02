<?php

require dirname(__DIR__, 1) . "/database/database.php";
class User
{
    private PDO $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM users";

        $stmt = $this->conn->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }
    public function getByEmail(string $email): array
    {
        $sql = "SELECT *
                FROM users WHERE email='$email'";

        $stmt = $this->conn->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }
    public function createUser(array $data): bool
    {
        $sql = "INSERT INTO users (username, email, password, profile_name)
                VALUES (:username, :email, :password, :profile_name)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":username", $data["username"], PDO::PARAM_STR);
        $stmt->bindValue(":email", $data["email"], PDO::PARAM_STR);
        $stmt->bindValue(":password", $data["password"], PDO::PARAM_STR);
        $stmt->bindValue(":profile_name", $data["profile_name"], PDO::PARAM_STR);
        $result = $stmt->execute();
        return $result;
    }
}
