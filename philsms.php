<?php

$apiEndpoint = 'https://app.philsms.com/api/v3/sms/send';


$data = [
    'recipient' => '639507808703',
    'sender_id' => 'PhilSMS',
    'type' => 'plain',
    'message' => ' Lorem ipsum dolor sit amet consectetur, adipisicing elit. Mollitia cumque at porro enim corrupti amet ipsa iure assumenda! Obcaecati ullam hic, exercitationem aut quasi modi nisi minima velit quidem consectetur.',
];


$ch = curl_init($apiEndpoint);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer 484|NxkXi9MZBkO9zgwPpSOHGAui1RspowRJjOzWq17y' ,
    'Content-Type: application/json',
    'Accept: application/json',
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CAINFO, "C:\cert\cacert.pem");


$response = curl_exec($ch);


if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {

    echo 'Response: ' . $response;
}

curl_close($ch);
