<?php
var_dump("test");
/*require 'composer/vendor/autoload.php';
$access_token = "TEST-3512230105254367-121621-bc8e603352e37bbf319fa1bb90b1a33c-570416670";

MercadoPago\SDK::setAccessToken($access_token);
$body = @file_get_contents('php://input');
$data = json_decode($body);
file_put_contents('notificaciones/'.$data->id.".json", $body);
switch($data->type) {
    case "payment":
        $payment = MercadoPago\Payment::find_by_id($data->data->id);
        http_response_code(201);
// var_dump($payment);
        break;
    case "test":
        echo "ok";
        break;
    case "plan":
        $plan = MercadoPago\Plan::find_by_id($_POST["id"]);
        break;
    case "subscription":
        $plan = MercadoPago\Subscription::find_by_id($_POST["id"]);
        break;
    case "invoice":
        $plan = MercadoPago\Invoice::find_by_id($_POST["id"]);
        break;
}