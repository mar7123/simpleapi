<?php
require dirname(__DIR__, 2) . "/models/Payment.php";
class Controller
{
    private Payment $model;
    public function __construct()
    {
        $this->model = new Payment;
    }
    function handler(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $result = $this->model->createPayment($data);
            if ($result) {
                echo json_encode(["message" => "payment created"]);
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
