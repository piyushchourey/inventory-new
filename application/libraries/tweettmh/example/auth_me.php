<?php

/**
 * Demonstration of the various OAuth flows. You would typically do this
 * when an unknown user is first using your application. Instead of storing
 * the token and secret in the session you would probably store them in a
 * secure database with their logon details for your website.
 *
 * When the user next visits the site, or you wish to act on their behalf,
 * you would use those tokens and skip this entire process.
 *
 * The Sign in with Twitter flow directs users to the oauth/authenticate
 * endpoint which does not support the direct message permission. To obtain
 * direct message permissions you must use the "Authorize Application" flows.
 *
 * Instructions:
 * 1) If you don't have one already, create a Twitter application on
 *      https://dev.twitter.com/apps
 * 2) From the application details page copy the consumer key and consumer
 *      secret into the place in this code marked with (YOUR_CONSUMER_KEY
 *      and YOUR_CONSUMER_SECRET)
 * 3) Visit this page using your web browser.
 *
 * @author themattharris
 */

require '../tmhOAuth.php';
require '../tmhUtilities.php';
$tmhOAuth = new tmhOAuth(array(
  'consumer_key'    => 'dhTsTvWYINTSgsIaqvAIg',
  'consumer_secret' => '4WSRNKJIuK46wMKhG3ZsHEANoaswDUrpr9Joli0pTY',
));


session_start();

function outputError($tmhOAuth) {
  echo 'Error: ' . $tmhOAuth->response['response'] . PHP_EOL;
  tmhUtilities::pr($tmhOAuth);
}

if ( $_POST['message']!='' && isset($_SESSION['access_token'])){ 
    $tmhOAuth = new tmhOAuth(array(
        'consumer_key'    => 'dhTsTvWYINTSgsIaqvAIg',
        'consumer_secret' => '4WSRNKJIuK46wMKhG3ZsHEANoaswDUrpr9Joli0pTY',
        'user_token'      => $_SESSION['access_token']['oauth_token'],
        'user_secret'     => $_SESSION['access_token']['oauth_token_secret'],
      ));

      $code = $tmhOAuth->request('POST', $tmhOAuth->url('1/statuses/update'), array(
        'status' => $_POST['message']
      ));

      if ($code == 200) {
        tmhUtilities::pr(json_decode($tmhOAuth->response['response']));
      } else {
        tmhUtilities::pr($tmhOAuth->response['response']);
      }
}elseif ( isset($_SESSION['access_token']) ) {
  $tmhOAuth->config['user_token']  = $_SESSION['access_token']['oauth_token'];
  $tmhOAuth->config['user_secret'] = $_SESSION['access_token']['oauth_token_secret'];

  $code = $tmhOAuth->request('GET', $tmhOAuth->url('1/account/verify_credentials'));
  if ($code == 200) {
    $resp = json_decode($tmhOAuth->response['response']);
    echo $resp->screen_name;
    echo '<img src="'.$resp->profile_image_url.'" alt="">';    
    echo '<form action="?" method="POST"><input type="text" name="message"><input type="submit" value="tweet" ></form>';
  } else {
    outputError($tmhOAuth);
  }
// we're being called back by Twitter
} elseif (isset($_REQUEST['oauth_verifier'])) {
  $tmhOAuth->config['user_token']  = $_SESSION['oauth']['oauth_token'];
  $tmhOAuth->config['user_secret'] = $_SESSION['oauth']['oauth_token_secret'];

  $code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/access_token', ''), array(
    'oauth_verifier' => $_REQUEST['oauth_verifier']
  ));

  if ($code == 200) {
    $_SESSION['access_token'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);
    unset($_SESSION['oauth']);
    header("Location: {$here}");
  } else {
    outputError($tmhOAuth);
  }
// start the OAuth dance
} else {
    $here = tmhUtilities::php_self();
  $callback = $here;

  $params = array(
    'oauth_callback'     => $callback
  );
  $code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/request_token', ''), $params);

  if ($code == 200) {
    $_SESSION['oauth'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);
    $method = 'authenticate';
    $force  = '&force_login=1';
    $authurl = $tmhOAuth->url("oauth/{$method}", '') .  "?oauth_token={$_SESSION['oauth']['oauth_token']}{$force}";
    echo '<p>To complete the OAuth flow follow this URL: <a target="_blank" href="'. $authurl . '">' . $authurl . '</a></p>';
  } else {
    outputError($tmhOAuth);
  }
}

?>
