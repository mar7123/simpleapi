<?php

require dirname(__DIR__, 1) . "/database/database.php";
class Course
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
                FROM courses";

        $stmt = $this->conn->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }
    public function getByID(int $id): array
    {
        $sql = "SELECT *
                FROM courses WHERE course_id='$id'";

        $stmt = $this->conn->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }
    public function createCourse(array $data): bool
    {
        $sql = "INSERT INTO courses (course_name, category, description, author, datentime, hours)
                VALUES (:course_name, :category, :description, :author, :datentime, :hours)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":course_name", $data["course_name"], PDO::PARAM_STR);
        $stmt->bindValue(":category", $data["category"], PDO::PARAM_STR);
        $stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);
        $stmt->bindValue(":author", $data["author"], PDO::PARAM_STR);
        $stmt->bindValue(":datentime", $data["datentime"], PDO::PARAM_STR);
        $stmt->bindValue(":hours", (float)$data["hours"]);
        $result = $stmt->execute();
        return $result;
    }
    public function updateCourse(array $data): bool
    {
        $sql = "UPDATE courses SET course_name=:course_name, category=:category, description=:description, author=:author, datentime=:datentime, hours=:hours WHERE course_id=:course_id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":course_id", $data["course_id"], PDO::PARAM_INT);
        $stmt->bindValue(":course_name", $data["course_name"], PDO::PARAM_STR);
        $stmt->bindValue(":category", $data["category"], PDO::PARAM_STR);
        $stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);
        $stmt->bindValue(":author", $data["author"], PDO::PARAM_STR);
        $stmt->bindValue(":datentime", $data["datentime"], PDO::PARAM_STR);
        $stmt->bindValue(":hours", (float)$data["hours"]);
        $result = $stmt->execute();
        return $result;
    }
    public function deleteCourse(int $id): bool
    {
        $sql = "DELETE FROM courses WHERE course_id=$id";

        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }
}
