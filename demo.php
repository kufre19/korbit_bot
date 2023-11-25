<?php


$data = '{
    "uuid": "e1830f1b-50fc-432e-80ec-15b58ccac867",
    "order_id": "a50441b3-48be-49e8-9a16-9d65d77fc79a",
    "currency": "ETH",
    "url_callback": "https://iamconst-m.com/korbit_bot/api/swap/payment/callback",
    "network": "eth",
    "status": "paid"
}';

$API_KEY = "K6YzbZuF5p5hGvNBPOo8D5eOaGD94TqnNlfXegqwDkEEP8eXyB92SidLsH8P9uegHeSWiavj9Q5MXzFJGJOgJu0EP85qhvOzbLcxTawcuOGfiUFzLbXVX7dTi2L0Xm1u";

$encodedData = base64_encode($data);
$sign = md5($encodedData . $API_KEY);

echo $sign;
echo PHP_EOL;
