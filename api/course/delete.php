<?php
require dirname(__DIR__, 2) . "/models/Course.php";
class Controller
{
    private Course $model;
    public function __construct()
    {
        $this->model = new Course;
    }
    function handler(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $result = $this->model->deleteCourse($data->course_id);
            if ($result) {
                echo json_encode(["message" => "course deleted"]);
                exit;
            } else {
                echo json_encode(["error" => "error"]);
                exit;
            }
        } else {
            echo json_encode(["error" => "HTTP POST only"]);
        }
    }
}
