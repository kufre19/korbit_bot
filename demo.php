<?php



$data = [

    'currency' => "DAI",
    'order_id' => "f362ec35-97da-4777-a2ab-988dfaa73d85",
    'url_callback' => "https://iamconst-m.com/korbit_bot/api/license/payment/callback",
    'status' => 'paid',
    "network"=> "eth",
];

$curl = curl_init();
$url = "https://api.cryptomus.com/v1/test-webhook/payment";
$body = json_encode($data,JSON_UNESCAPED_UNICODE);


// Now, $jsonData contains the JSON representation of the PHP array.


$API_KEY = "K6YzbZuF5p5hGvNBPOo8D5eOaGD94TqnNlfXegqwDkEEP8eXyB92SidLsH8P9uegHeSWiavj9Q5MXzFJGJOgJu0EP85qhvOzbLcxTawcuOGfiUFzLbXVX7dTi2L0Xm1u";



$headers = [
    'Accept: application/json',
    'Content-Type: application/json;charset=UTF-8',
    'Content-Length: ' . strlen($body),
    'merchant: 3a008604-cf0d-4946-958f-da1fa1b50de1',
    'sign: ' . md5(base64_encode($body) . $API_KEY)
];

curl_setopt_array(
    $curl,
    [
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $body,
        CURLOPT_RETURNTRANSFER => 1,
    ]
);

$response = curl_exec($curl);
$responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);


// Log the response to a file
$logFileName = "response.log";
file_put_contents($logFileName, $response);

// Close the cURL handle
curl_close($curl);

// Output the response to the browser
echo $response;
