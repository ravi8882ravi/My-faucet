<?php
$faucetpay_api = "2f6bd3d9998af0177f39e0408b6c987f49586fc712f91dd4079e045d5a8d396b";
$to_address = "USER_FAUCETPAY_BTC_ADDRESS";
$amount = "0.00000001";  // BTC Amount

$url = "https://faucetpay.io/api/v1/send";
$data = [
    "api_key" => $faucetpay_api,
    "to" => $to_address,
    "amount" => $amount,
    "currency" => "BTC"
];

$options = [
    "http" => [
        "header" => "Content-Type: application/json",
        "method" => "POST",
        "content" => json_encode($data)
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
echo $response;
?>
