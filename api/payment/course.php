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
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $result = $this->model->getByCourse($data->course_id);
            echo json_encode($result);
        } else {
            echo json_encode(["error" => "HTTP GET only"]);
        }
    }
}
