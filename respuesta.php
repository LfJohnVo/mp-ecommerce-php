<?php
require 'composer/vendor/autoload.php';
$access_token = "TEST-3512230105254367-121621-bc8e603352e37bbf319fa1bb90b1a33c-570416670";

// Agrega credenciales
MercadoPago\SDK::setAccessToken($access_token);

$data=$_GET;
switch($data['id']){
    case "failure":
        echo "<h2>El pago fue rechazado</h2>";
        break;
    case "pending":
        echo "<h2>El pago está siendo procesado</h2>";
        break;
    case "success":
        echo "<h2>Aprobado";
        echo "</p>		".$data['id'];
        echo "<p>Payment id:". $data['payment_id'];
        echo "</p>preference_id:".$data['preference_id'];
        echo "</p>external_reference:".$data['external_reference']."</h2>";
        break;
}