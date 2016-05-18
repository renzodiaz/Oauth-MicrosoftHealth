<?php
/**
 * Created by PhpStorm.
 * User: renzo
 * Date: 5/17/16
 * Time: 10:25 PM
 */

namespace MicrosoftHealth;


class CustomOauth
{

    /** Public Attributes **/
    public $curlHeaders;
    public $responseCode;

    /** Private Attributes **/
    private $_authorizeUrl      = 'https://login.live.com/oauth20_authorize.srf';
    private $_accessTokenUrl    = 'https://login.live.com/oauth20_token.srf';

    /** Method construct **/
    public function  __construct()
    {
        $this->curlHeaders  = [];
        $this->responseCode = 0;
    }

    /**
     * Method Request Access Code
     * $client_id = your client_id
     * $redirect_url = callback url
     * $scopes = string 'mshealth.ReadProfile mshealth.ReadActivityHistory offline_access'
     **/
    public function requestAccessCode($client_id, $redirect_url, $scopes)
    {
        return($this->_authorizeUrl. "?client_id=" . $client_id . "&scopes=" . $scopes . "&response_type=code&redirect_uri=" . $redirect_url);
    }

    /**
     * Method Get Access_token
     * $client_id
     * $client_secret
     * $redirect_url
     * $response_code
     **/
    public function getAccessToken($client_id, $client_secret, $redirect_url, $response_code)
    {
        $ch = $this->initCurl($this->_accessTokenUrl);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . base64_encode($client_id . ':' . $client_secret)
        ] );

        $post_fields = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_url . '&client_secret=' . $client_secret . '&code=' . urldecode($response_code) . '&grant_type=authorization_code';

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);

        $response = curl_exec($ch);

        if ($response == false) {

            die("curl_exec() failed. Error: " . curl_error($ch));

        }

        return json_decode($response);

    }

    /**
     * Method Get New Token
     * $client_id
     * $client_secret
     * $redirect_url
     * $refresh_token
     **/

    public function refreshToken($client_id, $client_secret, $redirect_url, $refresh_token)
    {
        $ch = $this->initCurl($this->_accessTokenUrl);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . base64_encode($client_id . ":" . $client_secret)
        ));

        $post_fields = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_url . '&client_secret=' . $client_secret . '&refresh_token=' . urldecode($refresh_token) . '&grant_type=refresh_token';

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);

        $response = curl_exec($ch);

        if ($response == false) {

            die("curl_exec() failed. Error: " . curl_error($ch));

        }

        return json_decode($response);
    }

    /**
     * Method Init Curl
     * $url
     **/
    public function initCurl($url)
    {
        $ch = null;

        if ( ($ch = @curl_init($url)) == false ) {

            header("HTTP/1.1 500", true, 500);
            die("Cannot initialize cUrl session. Is cUrl enabled for your PHP installation?");

        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 1);

        return($ch);

    }

    /**
     * Method Ger resources
     * $url
     * $acces_token
     * $params = url parameters
     **/
    public function request($url, $access_token, $params)
    {
        $full_url = http_build_query($url, $params);

        $ch = $this->initCurl($full_url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $access_token
        ));

        $response = curl_exec($ch);

        if ($response == false) {

            die("curl_exec() failed. Error: " . curl_error($ch));

        }

        //Parse JSON return object.
        return json_decode($response);
    }

}