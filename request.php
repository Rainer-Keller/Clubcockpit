<?php

class Request
{
    function __construct() {
        $this->data = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() != JSON_ERROR_NONE) {
            error_log("JSON error");
            return;
        }

        $this->response = [];
    }

    function __destruct() {
        $answer = [
            "Success" => $this->success,
            "Message" => $this->message,
            "Data" => $this->response,
        ];

        http_response_code(200);
        echo json_encode($answer);
    }

    public function setSuccess($message) {
        $this->success = true;
        $this->message = $message;
    }

    public function setError($message) {
        $this->success = false;
        $this->message = $message;
    }

    public $data;
    public $response;
    private $message;
    private $success;
}
?>
