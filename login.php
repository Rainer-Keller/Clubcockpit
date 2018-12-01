<?php

require("request.php");
require("session.php");

$request = new Request();
$session = new Session();

if ($session->login($request->data["UserId"], $request->data["Password"])) {
    $request->response["SessionId"] = $session->sessionId();
    $request->setSuccess("Logged in");
} else {
    $request->setError("Login failed");
    return;
}

?>
