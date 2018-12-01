<?php
class Session
{
  public function load($sessionId) {
        $data = json_decode(file_get_contents("session-".$sessionId), true);
        if (json_last_error() != JSON_ERROR_NONE) {
            error_log("JSON error");
            $this->clear();
            return false;
        }

        $this->sessionId = $sessionId;
        $this->userId = $data["UserId"];
        $this->expirationDate = new DateTime($data["ExpirationDate"]);

        if ($this->isValid()) {
            $this->expirationDate = new DateTime("now");
            $this->expirationDate->modify("+30 seconds"); // Valid for 30 seconds
            $this->save();
            return true;
        } else {
            return false;
        }
    }

    public function isValid() {
        if ($this->expirationDate < (new DateTime("now"))) {
            error_log("Session has expired");
            return false;
        }
        return true;
    }

    public function login($userId, $password) {
        if ($userId != "John Doe" || $password != "geheim") {
            error_log("Login failed");
            return false;
        }

        $this->sessionId = md5(uniqid(microtime()));
        $this->userId = $userId;
        $this->expirationDate = new DateTime();
        $this->expirationDate->modify("+30 seconds"); // Valid for 30 seconds

        $this->save();
        return true;
    }

    public function invalidate() {
        $this->clear();
        unlink("session-".$this->sessionId);
    }

    public function userId() {
        return $this->userId;
    }

    public function sessionId() {
        return $this->sessionId;
    }

    private function save() {
        $data = [
            "UserId" => $this->userId,
            "ExpirationDate" => $this->expirationDate->format('c'),
        ];
        file_put_contents("session-".$this->sessionId, json_encode($data), LOCK_EX);
    }

    private function clear() {
        $sessionId = null;
        $userId = null;
        $expirationDate = null;
    }

    private $sessionId;
    private $expirationDate;
    private $userId;
}
?>
