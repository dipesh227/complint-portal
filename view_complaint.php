<?php
include('config.php');
include('api/swachhata.php');
include('templates/header.php');

if (!isset($_GET['id'])) {
    echo "No complaint ID provided.";
    include('templates/footer.php');
    exit();
}

$complaintId = $_GET['id'];
$params = [
    'vendor_name' => VENDOR_NAME,
    'access_key' => ACCESS_KEY,
    'complaintId' => $complaintId
];
$complaint = getComplaintDetails($params);

if (empty($complaint['response'])) {
    echo "Complaint not found.";
    include('templates/footer.php');
    exit();
}

$complaint = $complaint['response'];
?>

<h1>Complaint Details</h1>
<p><strong>Title:</strong> <?php echo htmlspecialchars($complaint['title']); ?></p>
<p><strong>Location:</strong> <?php echo htmlspecialchars($complaint['complaintLocation']); ?></p>
<p><strong>Landmark:</strong> <?php echo htmlspecialchars($complaint['complaintLandmark']); ?></p>
<p><strong>Status:</strong> <?php echo htmlspecialchars($complaint['status']); ?></p>

<?php include('templates/footer.php'); ?>
