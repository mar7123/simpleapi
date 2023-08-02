<?php
require dirname(__DIR__, 1) . "/models/User.php";
class Controller
{
    private User $model;
    public function __construct()
    {
        $this->model = new User;
    }
    function handler(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $result = $this->model->getAll();
            echo json_encode($result);
        } else {
            echo json_encode(["error" => "HTTP GET only"]);
        }
    }
}
