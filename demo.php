<?php


$data = [
    "order_id" => "a50441b3-48be-49e8-9a16-9d65d77fc79a",
    "currency" => "ETH",
    "url_callback" => "https://iamconst-m.com/korbit_bot/api/swap/payment/callback",
    "network" => "eth",
    "status" => "paid"
];

$jsonData = json_encode($data);
echo $jsonData;
echo PHP_EOL;

// Now, $jsonData contains the JSON representation of the PHP array.


$API_KEY = "K6YzbZuF5p5hGvNBPOo8D5eOaGD94TqnNlfXegqwDkEEP8eXyB92SidLsH8P9uegHeSWiavj9Q5MXzFJGJOgJu0EP85qhvOzbLcxTawcuOGfiUFzLbXVX7dTi2L0Xm1u";

$encodedData = base64_encode($jsonData);
$raw = $encodedData . $API_KEY;
$sign = md5($raw);

echo $sign;
echo PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;
echo $raw;

