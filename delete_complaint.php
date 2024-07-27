<?php
include('config.php');
include('api/swachhata.php');

if (!isset($_GET['id'])) {
    echo "No complaint ID provided.";
    exit();
}

$complaintId = $_GET['id'];
$params = [
    'vendor_name' => VENDOR_NAME,
    'access_key' => ACCESS_KEY,
    'complaintId' => $complaintId
];
$response = deleteComplaint($params);

header('Location: index.php');
exit();
?>
