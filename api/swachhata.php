<?php
function postComplaint($data) {
    $url = API_BASE_URL . 'complaint/post';
    return apiRequest($url, $data);
}

function getComplaints($params) {
    $url = API_BASE_URL . 'complaint/list';
    return apiRequest($url, $params);
}

function getComplaintDetails($params) {
    $url = API_BASE_URL . 'complaint/details';
    return apiRequest($url, $params);
}

function updateComplaint($data) {
    $url = API_BASE_URL . 'complaint/update';
    return apiRequest($url, $data);
}

function deleteComplaint($params) {
    $url = API_BASE_URL . 'complaint/delete';
    return apiRequest($url, $params);
}

function apiRequest($url, $data) {
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result, true);
}
?>
