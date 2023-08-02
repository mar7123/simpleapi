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
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $url = strtok($_SERVER["REQUEST_URI"], '?');
            $truncurl = rtrim($url, "/");
            $id = substr($truncurl, strrpos($truncurl, "/") + 1);
            $result = $this->model->getByID((int)$id);
            echo json_encode($result);
        } else {
            echo json_encode(["error" => "HTTP GET only"]);
        }
    }
}
