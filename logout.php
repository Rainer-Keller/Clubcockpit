<?php

require("request.php");
require("session.php");

$request = new Request();
$session = new Session();

if (!$session->load($request->data["SessionId"])) {
    $request->setError("Not logged in");
    return;
} else {
    $session->invalidate();
    $request->setSuccess("Logged Out");
}

?>
