<?php

/**
 * Tweets a message from the user whose user token and secret you use.
 *
 * Although this example uses your user token/secret, you can use
 * the user token/secret of any user who has authorised your application.
 *
 * Instructions:
 * 1) If you don't have one already, create a Twitter application on
 *      https://dev.twitter.com/apps
 * 2) From the application details page copy the consumer key and consumer
 *      secret into the place in this code marked with (YOUR_CONSUMER_KEY
 *      and YOUR_CONSUMER_SECRET)
 * 3) From the application details page copy the access token and access token
 *      secret into the place in this code marked with (A_USER_TOKEN
 *      and A_USER_SECRET)
 * 4) Visit this page using your web browser.
 *
 * @author themattharris
 */

require '../tmhOAuth.php';
require '../tmhUtilities.php';
$tmhOAuth = new tmhOAuth(array(
  'consumer_key'    => 'dhTsTvWYINTSgsIaqvAIg',
  'consumer_secret' => '4WSRNKJIuK46wMKhG3ZsHEANoaswDUrpr9Joli0pTY',
  'user_token'      => '133980780-MqxhyrWyitKVLCOpBy8lP1VQ74H6gxExUbWArnds',
  'user_secret'     => 'bzG3doLCPgrH4VJUWRNqjoT8dgVttmRSIXIpNtry3c',
));

/*$code = $tmhOAuth->request('GET', $tmhOAuth->url('1/users/profile_image'), array(
  'screen_name' => 'inimarin',
));

if ($code == 302) {
  $profile_image = $tmhOAuth->response['headers']['location'];
}

echo '<pre>';print_r($profile_image);*/

$code = $tmhOAuth->request('GET', $tmhOAuth->url('1/account/verify_credentials'));
$data = json_decode($tmhOAuth->response['response']);
echo '<img src="'.$data->profile_image_url.'" alt="">';
echo '<pre>';print_r($data);
