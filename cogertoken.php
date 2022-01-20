<?php

require_once('./vendor/autoload.php');

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'application',    // The client ID assigned to you by the provider
    'clientSecret'            => 'secret',    // The client password assigned to you by the provider
    'redirectUri'             => 'https://google.es/',
    'urlAuthorize'            => 'https://examenserver.herokuapp.com/oauth/auth',
    'urlAccessToken'          => 'https://examenserver.herokuapp.com/oauth/token',
    'urlResourceOwnerDetails' => 'https://service.example.com/resource'
]);

try {

    // Try to get an access token using the resource owner password credentials grant.
    $accessToken = $provider->getAccessToken('password', [
        'username' => 'pedroetb',
        'password' => 'password'
    ]);

    $_SESSION['oauth2state'] = $provider->getState();

} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

    // Failed to get the access token
    exit($e->getMessage());

}

?>