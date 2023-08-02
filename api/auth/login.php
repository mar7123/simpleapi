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
            $data = json_decode($json);
            $result = $this->model->getByEmail($data->email);
            if (empty($result)) {
                echo json_encode(["error" => "account not found"]);
                exit;
            }
            if ($result[0]["password"] != $data->password) {
                echo json_encode(["error" => "incorrect password"]);
                exit;
            }
            echo json_encode(["status" => "ok"]);
        } else {
            echo json_encode(["error" => "HTTP POST only"]);
        }
    }
}
