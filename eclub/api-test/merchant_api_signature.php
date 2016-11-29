<?php
function merchant_signature($source) {
	//formula of string
	//merchant_key . merchant_password . merchant_transaction_code
	return base64_encode(hex2bin(sha1($source)));
}

function hex2bin($hexSource) {
	$bin = '';
	for ($i=0;$i<strlen($hexSource);$i=$i+2) {
		$bin .= chr(hexdec(substr($hexSource,$i,2)));
	}
	return $bin;
}
?>