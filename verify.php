<?php
$access_token = 'dTPLwK6K5H4WJwpbIbUThLs7kBvVpsIcwEMPyE3i4rx9MbkDEa5E5Dxl/MxikH1Tp16uOR6xGggV9EYy/LT8EmwCt94+dkgMM7pheUuse9WbT4X4/ovqEEejm7Kp/hLs3P/qYMS/RlsBmL66OB87EwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

