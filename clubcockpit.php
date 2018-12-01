<?php

require("request.php");
require("session.php");

$request = new Request();
$session = new Session();

if (!$session->load($request->data["SessionId"])) {
    $request->setError("Zugriff verweigert");
    return;
} else {
    $request->setSuccess("Zugriff erlaubt");
}

?>
