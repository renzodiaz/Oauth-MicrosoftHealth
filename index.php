<?php
/**
 * Created by PhpStorm.
 * User: renzo
 * Date: 5/17/16
 * Time: 11:00 PM
 */

// Require dependencies
require_once 'src/CustomOauth.php';

use MicrosoftHealth\CustomOauth;

// Credentials
$credentials = [
    'client_id'     => 'your-client-id',
    'client_secret' => 'your-client-secret',
    'callback_url'  => 'your-callback-url' // In this case the callback url is the same page.
];

if ( !isset($_GET['code']) ) {

    // Scopes with spece
    $scopes= 'mshealth.ReadProfile mshealth.ReadActivityHistory offline_access';

    $oauth = new CustomOauth();
    $url = $oauth->requestAccessCode($credentials->client_id, $credentials->callback_url, $scopes);

    header("Location:" . $url );exit;
} else {

    $oauth = new CustomOauth();

    if (isset($_GET['code'])) {

        // Get access_token
        $token = $oauth->getAccessToken($credentials->client_id, $credentials->client_secret, $credentials->callback_url, $_GET['code'] );

        if ( !empty($token) ) {

            echo '<pre>';
            var_dump($token);
            echo '</pre><hr/>';

            // Get Profile
            $profile = $oauth->request('https://api.microsofthealth.net/v1/me/Profile/', $token->access_token, '');
            echo '<pre>';
            var_dump($profile);
            echo '</pre><hr/>';

            // Get Activities
            $activities = $oauth->request('https://api.microsofthealth.net/v1/me/Activities/', $token->access_token, '');
            echo '<pre>';
            var_dump($activities);
            echo '</pre><hr/>';

        }

    }


}