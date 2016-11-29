<?php
//order_email xml process between merchant and eClubStore

include('merchant_api_signature.php');


//eclub cURL path DO NOT CHANGE THIS. For testing purposes
$url = 'http://test.eclubstore.com/reseller/merchant-panel/request_xml.php';

//eclub cURL path DO NOT CHANGE THIS. Live server
//$url = 'https://reseller.eclubstore.com/merchant-panel/request_xml.php';


//POST input
$merchant_email 		= '';
$merchant_password 		= '';
$merchant_key 			= '';
$signature 				= '';
$transaction_code 		= '';

//create signature
$signature = merchant_signature($merchant_key . md5($merchant_password) . $transaction_code);

//order_email xml
$fields_string = '<?xml version="1.0" encoding="UTF-8" ?>
<request>
	<Type>order_email</Type>
	<MerchantEmail>'.$merchant_email.'</MerchantEmail>
	<Signature>'.$signature.'</Signature>
	<TransactionCode>'.$_POST['transaction_code'].'</TransactionCode>
</request>';

//open cURL connection
$ch = curl_init($url);

//set the url, number of POST vars, POST data
$options = array (	CURLOPT_CUSTOMREQUEST => "POST", // return web page
					CURLOPT_POSTFIELDS => $fields_string, // return web page
					CURLOPT_RETURNTRANSFER => true, // return web page
					CURLOPT_HEADER => false, // don't return headers
					CURLOPT_FOLLOWLOCATION => true, // follow redirects
					CURLOPT_AUTOREFERER => true,
					CURLOPT_SSL_VERIFYPEER => 1,
					CURLOPT_SSL_VERIFYHOST => 2); // set referer on redirect
curl_setopt_array ($ch, $options);

//execute post
$result = curl_exec($ch);

//close cURL connection
curl_close($ch);

if($result!='' || $result!==false) {
	//result returned
	//merchant can begin their process here
	
	echo '<pre>'.htmlspecialchars($result).'</pre>';
} else {
	//error
}
?>