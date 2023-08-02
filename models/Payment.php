<?php

require dirname(__DIR__, 1) . "/database/database.php";
class Payment
{
    private PDO $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function getByUser(int $id): array
    {
        $sql = "SELECT *
                FROM payments WHERE user_id=$id";

        $stmt = $this->conn->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }
    public function getByCourse(int $id): array
    {
        $sql = "SELECT *
                FROM users WHERE course_id=$id";

        $stmt = $this->conn->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }
    public function createPayment(array $data): bool
    {
        $sql = "INSERT INTO payments (user_id, course_id, cc, cvc, ccholder)
                VALUES (:user_id, :course_id, :cc, :cvc, :ccholder)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":user_id", $data["user_id"], PDO::PARAM_INT);
        $stmt->bindValue(":course_id", $data["course_id"], PDO::PARAM_INT);
        $stmt->bindValue(":cc", $data["cc"], PDO::PARAM_INT);
        $stmt->bindValue(":cvc", $data["cvc"], PDO::PARAM_INT);
        $stmt->bindValue(":ccholder", $data["ccholder"], PDO::PARAM_STR);
        $result = $stmt->execute();
        return $result;
    }
}
