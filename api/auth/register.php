<?php
require dirname(__DIR__, 2) . "/models/User.php";
class Controller
{
    private User $model;
    public function __construct()
    {
        $this->model = new User;
    }
    function handler(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $checkav = $this->model->getByEmail($data["email"]);
            if(!empty($checkav)){
                echo json_encode(["error" => "user already exist"]);
                exit;
            }
            $result = $this->model->createUser($data);
            if ($result) {
                echo json_encode(["message" => "account created"]);
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
