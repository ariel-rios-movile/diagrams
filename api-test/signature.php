<?php

define("EMAIL", "gustavo.ortiz@movile.com");
define("MERCHANT_KEY", "q7h96juAOq37BMHq2eZgFP1JRo8i7329");
define("MERCHANT_PASSWORD", "test@telefonica923");
define("TRANSACTION_CODE", "GS0000012");


$merchantPasswordMd5 = md5(MERCHANT_PASSWORD);

$rawSignature = MERCHANT_KEY . $merchantPasswordMd5 . TRANSACTION_CODE;

$signature = sha1($rawSignature);

$raw = "qcBFjObYAK1281yr1ge16dqwyewtavdastdfasf412GS0000012";
$expected = "w/u8r3opxhZ9K2D11Rcwyu1ueNg=";

$signature = sha1($raw);
echo "Signature raw: ${raw}\n";
echo "Signature sha1: ${signature}\n";
echo "Signature base64: ", base64_encode($signature), "\n";
echo "Expected: ", $expected;

?>
