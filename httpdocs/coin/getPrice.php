<?php

$mtGoxTicker = mtgox_query('2/BTCUSD/money/ticker');
$BTCeTicker = btce_query(

echo "MtGox Current Sell Value: " . $mtGoxTicker["data"]["buy"]["value"] . "<br>";    //current value we can sell at 
echo "MtGox Current Buy Value: " . $mtGoxTicker["data"]["sell"]["value"] . "<br>";    //current value we can buy at 

echo "MtGox Current Buy Value: " . $mtGoxTicker["data"]["sell"]["value"] . "<br>";    //current value we can sell at 


var_dump($mtGoxTicker);






//--------FUNCTIONS---------

function mtgox_query($path, array $req = array()) {
	// API settings
	$key = 'f5fb03f0-b29b-4462-8f13-a637ab4805cb';
	$secret = 'jt+LXNvL6zMlK7qvDfQGDD6ha1gev1e9OfVDIKWGYnrbwe4r3HslC6/iYG7WKx9FQpESy4bbMVuGAcTq5b2hWA==';
 
	// generate a nonce as microtime, with as-string handling to avoid problems with 32bits systems
	$mt = explode(' ', microtime());
	$req['nonce'] = $mt[1].substr($mt[0], 2, 6);
 
	// generate the POST data string
	$post_data = http_build_query($req, '', '&');
 
	$prefix = '';
	if (substr($path, 0, 2) == '2/') {
		$prefix = substr($path, 2)."\0";
	}
 
	// generate the extra headers
	$headers = array(
		'Rest-Key: '.$key,
		'Rest-Sign: '.base64_encode(hash_hmac('sha512', $prefix.$post_data, base64_decode($secret), true)),
	);
 
	// our curl handle (initialize if required)
	static $ch = null;
	if (is_null($ch)) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MtGox PHP client; '.php_uname('s').'; PHP/'.phpversion().')');
	}
	curl_setopt($ch, CURLOPT_URL, 'data.mtgox.com/api/'.$path);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
	// run the query
	$res = curl_exec($ch);
	if ($res === false) throw new Exception('Could not get reply: '.curl_error($ch));
	$dec = json_decode($res, true);
	if (!$dec) throw new Exception('Invalid data received, please make sure connection is working and requested API exists');
	return $dec;
}

function btce_query($method, array $req = array()) {
        // API settings
        $key = 'SZWFJH4Q-SQ6X70RB-NS9ZS6SA-9RSUFTTT-CTG3E0LP'; // your API-key
        $secret = '487d62ed123054fd1fe005dcb03437fef78bc0eccb15470c741a3f28080d1ee5'; // your Secret-key
 
        $req['method'] = $method;
        $mt = explode(' ', microtime());
        $req['nonce'] = $mt[1];
       
        // generate the POST data string
        $post_data = http_build_query($req, '', '&');
 
        $sign = hash_hmac("sha512", $post_data, $secret);
 
        // generate the extra headers
        $headers = array(
                'Sign: '.$sign,
                'Key: '.$key,
        );
 
        // our curl handle (initialize if required)
        static $ch = null;
        if (is_null($ch)) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; BTCE PHP client; '.php_uname('s').'; PHP/'.phpversion().')');
        }
        curl_setopt($ch, CURLOPT_URL, 'https://btc-e.ru/tapi/');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
        // run the query
        $res = curl_exec($ch);
        if ($res === false) throw new Exception('Could not get reply: '.curl_error($ch));
        $dec = json_decode($res, true);
        if (!$dec) throw new Exception('Invalid data received, please make sure connection is working and requested API exists');
        return $dec;
}
?>