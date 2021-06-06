<?php
require('./bootstrap.php');

// read a JWT from the command line
if (! isset($argv[1])) {
    exit('Please provide a key to verify');
}

$jwt = $argv[1];

list($header, $payload, $signature) = explode(".", $jwt);

$plainHeader = base64_decode($header);
echo "Header:\n$plainHeader\n\n";

$plainPayload = base64_decode($payload);
echo "Payload:\n$plainPayload\n\n";

