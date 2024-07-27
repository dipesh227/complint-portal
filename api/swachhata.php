<?php
include('../config.php');

function callAPI($method, $endpoint, $data = []) {
    $url = API_BASE_URL . $endpoint;
    $headers = [
        'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if ($method === 'POST' || $method === 'PUT') {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [
        'httpcode' => $httpcode,
        'response' => json_decode($response, true)
    ];
}

function postComplaint($data) {
    return callAPI('POST', '/post-complaint', $data);
}

function getComplaints($params = []) {
    $endpoint = '/getComplaints?' . http_build_query($params);
    return callAPI('GET', $endpoint);
}
?>
