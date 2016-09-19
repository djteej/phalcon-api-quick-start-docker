<?php
$publicHash  = '29a52c266062278a99876caa779e5e232a283b0f436a8f507309deabb618f2c3';
$privateHash = '3e617067d2c94a8b783f40338d284b55a972044a2e91642970bc3cee71ba0d54';
$protocol    = 'http';
$host        = 'localhost';
$port        = '8000';
$testGET     = true;
$testPOST    = true;

// Sample GET request
if ($testGET) {

    $endpoint = '/';
    $content = null;

    $hash = hash_hmac('sha256', $content, $privateHash);

    $headers = array(
        sprintf('X-Public: %s', $publicHash),
        sprintf('X-Hash: %s', $hash),
    );

    $ch = curl_init(sprintf('%s://%s:%s%s', $protocol, $host, $port, $endpoint));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if (!empty($response)) {
        $data = json_decode($response);
    } else {
        $data = sprintf(
            'No response from: %s://%s:%s%s',
            $protocol,
            $host,
            $port,
            $endpoint
        );
    }

    curl_close($ch);

    echo sprintf(
        'GET Result %s%s%s',
        PHP_EOL,
        print_r(json_encode($data, JSON_PRETTY_PRINT), true),
        PHP_EOL
    );
}

// Sample POST request
if ($testPOST) {

    $endpoint = '/';
    $content = json_encode(array(
        'test' => 'sample content'
    ));

    $hash = hash_hmac('sha256', $content, $privateHash);

    $headers = array(
        sprintf('X-Public: %s', $publicHash),
        sprintf('X-Hash: %s', $hash),
    );

    $ch = curl_init(sprintf('%s://%s:%s%s', $protocol, $host, $port, $endpoint));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
    $response = curl_exec($ch);

    if (!empty($response)) {
        $data = json_decode($response);
    } else {
        $data = sprintf(
            'No response from: %s://%s:%s%s',
            $protocol,
            $host,
            $port,
            $endpoint
        );
    }

    curl_close($ch);

    echo sprintf(
        'POST Result %s%s%s',
        PHP_EOL,
        print_r(json_encode($data, JSON_PRETTY_PRINT), true),
        PHP_EOL
    );
}

