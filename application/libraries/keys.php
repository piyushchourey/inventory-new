<?php
    //show all errors - useful whilst developing
    error_reporting(E_ALL);

    // these keys can be obtained by registering at http://developer.ebay.com
    
    $production         = false;   // toggle to true if going against production
    $compatabilityLevel = 551;    // eBay API version
    
    if ($production) {
        $devID = 'DDD';   // these prod keys are different from sandbox keys
        $appID = 'AAA';
        $certID = 'CCC';
        //set the Server to use (Sandbox or Production)
        $serverUrl = 'https://api.ebay.com/ws/api.dll';      // server URL different for prod and sandbox
        //the token representing the eBay user to assign the call with
        $userToken = 'YOUR_PROD_TOKEN';          
    } else {  
        // sandbox (test) environment
        $devID = '3c504508-e0d4-4725-bb0b-39a74fc9a988';         // insert your devID for sandbox
        $appID = 'pramodja-1b75-4ff3-9975-949c420cecdf';   // different from prod keys
        $certID = '8fd2a71d-e207-4436-82be-9dcb2f7b9d0f';  // need three 'keys' and one token
        //set the Server to use (Sandbox or Production)
        $serverUrl = 'https://api.sandbox.ebay.com/ws/api.dll';
        // the token representing the eBay user to assign the call with
        // this token is a long string - don't insert new lines - different from prod token
        $userToken = 'AgAAAA**AQAAAA**aAAAAA**hJ+kUQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhCpSHoQ+dj6x9nY+seQ**aDQCAA**AAMAAA**447Kx3c3HlwnNpoU2h1AWEQ1kgDM/1NZV3XWy3D7jibfwsNBZWVn4xc+a68fJbNrQI64ml+5QIH6k35wP4aG5uXH8fA8+BAPswYnoLK+oGr/0/AdlK02+U+nB1EsXt+0lXd/H+PVTOirgXzlXSfzcfKWVYECzDdcJwiG+OwNcJDoYMzR1Xoq233tIRQKqjJeU2RpcUZpAng5rQinwMnPTIswYvyMsDkaRrdEwbbG0mh1q2SbIEWxhH1hUD5j2s1Onzwziunsf3oz6Q6H26D0ezIkYjESFJQ3fDw12wRGRaUQVnDWMKxAhZTCCn6fkqHiFo1FLVdPnsR9+rXR2C+D5Bce5zLf//lJQD2CmB2tSq/NXeqmcdSd2Bb+NGmDV5MQhmo8m3N8ghlHrf6jT6bvLTVL+YHmOLI07ZIXKQjrDejHXdDbF8QlxPN1il1UCJ3bSWUgVWf6F9QU9krHFZ55jaW6626+Nn5hL0bKsLnLmmZWozqmpi+qFWhF5JRhU4Ffy5huTbZk8d2/GdzfUGPopO//YNwByswN9jU3m8pgl7o+jPGPjuBE/PFxvJmCwaqVmFV5hiom1nHuIzCRTPykmP3y4c8on0zR/aGfvtZ+xxjWE8pNeB0q0a8Y5KmYTdkM/+Ngi0LdUdZTOEpD+r0QAcjwFBtGFT8KfZELt1mFChlGlc4A0P6Savn83Cvs8BBOWfIvbGdZFq9VTzBOeCuk++bPArSvLRwpOTDtYxd1QhyDPbNZdivJ2TdDVwrpAkpQ';                 
    }
    
    
?>
