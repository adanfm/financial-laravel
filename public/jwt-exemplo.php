<?php

//HEADER
$header = [
    'alg'   =>  'HS256',
    'typ'   =>  'JWT',
];

//PAYLOAD
$payload = [
    'first_name'    =>   'Adan',
    'last_name'     =>  'Medeiros',
    'email'         =>  'adan.grg@gmail.com'
];

$header = json_encode($header);
$payload = json_encode($payload);

echo 'Header: ' . $header;
echo "\n";
echo "Payload: " . $payload;
echo "\n";

echo 'Header: ' . base64_encode($header);
echo "\n";
echo "Payload: " . base64_encode($payload);
echo "\n";
//SIGNATURE

$header = base64_encode($header);
$payload = base64_encode($payload);
$key = md5('treta_news');

echo $key;
echo "\n";
$signature = hash_hmac('sha256', "$header.$payload", $key, true);

echo $signature;
echo "\n";

echo "Signature: " . base64_encode($signature);
echo "\n\n\n\n\n";

$signature = base64_encode($signature);

echo "Token: $header.$payload.$signature" ;
echo "\n\n\n\n\n";
