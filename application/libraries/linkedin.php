<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Linkedin
{

    function __construct()
    {
       
	
    }

    public function getAuthorizationCode($type = NULL)
    {
        
        $obj = &get_instance();
	$obj->load->helper('url');
	$obj->load->library('session');
	$obj->config->item('base_url');
       
        
     
	$params = array('response_type' => 'code',
	     'client_id' => '75ep0wvt3xf3z8',
	    'scope' => 'r_fullprofile r_contactinfo r_emailaddress r_network w_messages',
	    'state' => uniqid('', true),
	    'redirect_uri' => base_url().'invite/linkedinAuthorize',
	);
	$url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);
	if ($type)
	    $obj->session->set_userdata('social_type', $type);
	$obj->session->set_userdata('state', $params['state']);
	$_SESSION['state'] = $params['state'];

	return $url;
    }

    
    

    public function getAccessToken($code)
    {
	$params = array('grant_type' => 'authorization_code',
	    'client_id' => '75ep0wvt3xf3z8',
	    'client_secret' => 'QEe6ur19f7eB45EQ',
	    'code' => $code,
	    'redirect_uri' => base_url().'invite/linkedinAuthorize',
	);
	$url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
	$context = stream_context_create(
		array('http' =>
		    array('method' => 'POST',
		    )
		)
	);
        $ch = curl_init();
              
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

// In wamp-like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set 
// the directory path of the certificate as shown below:
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if( !($res = curl_exec($ch)) ) {
    // error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);
	
        
	$token = json_decode($res);
     
	$_SESSION['access_token'] = $token->access_token;
	$_SESSION['expires_in'] = $token->expires_in;
	$_SESSION['expires_at'] = time() + $_SESSION['expires_in'];
        
	return $token->access_token;
    }

    public function fetch($method, $resource,$token, $body = '')
    {
	$params = array('oauth2_access_token' => $token,
	    'format' => 'json',
	);
	$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
	$context = stream_context_create(
		array('http' =>
		    array('method' => $method,
		    )
		)
	);
	$response = file_get_contents($url, false, $context);
	return json_decode($response);
    }
    
    
    public function send($resource,$token,$body){
        $params = array('oauth2_access_token' => $token
	   
	);
	$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $verbose = fopen('php://temp', 'rw+');
        curl_setopt($ch, CURLOPT_STDERR, $verbose);
       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','x-li-format: json'));  
        
        if( !($res = curl_exec($ch)) ) {
     die(var_dump(curl_error($ch)));
    curl_close($ch);
    exit;
}
curl_close($ch);

return $res;
    }

}

?>