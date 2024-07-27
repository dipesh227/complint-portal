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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'vendor_name' => VENDOR_NAME,
        'access_key' => ACCESS_KEY,
        'complaintId' => $complaintId,
        'complaintLocation' => $_POST['complaintLocation'] ?? '',
        'complaintLandmark' => $_POST['complaintLandmark'] ?? '',
        'status' => $_POST['status'] ?? ''
    ];
    $response = updateComplaint($data);
}

?>

<h1>Update Complaint</h1>
<form method="POST" action="update_complaint.php?id=<?php echo htmlspecialchars($complaintId); ?>">
    <div class="form-group">
        <label for="complaintLocation">Location</label>
        <input type="text" id="complaintLocation" name="complaintLocation" value="<?php echo htmlspecialchars($complaint['complaintLocation']); ?>" required>
    </div>
    <div class="form-group">
        <label for="complaintLandmark">Landmark</label>
        <input type="text" id="complaintLandmark" name="complaintLandmark" value="<?php echo htmlspecialchars($complaint['complaintLandmark']); ?>" required>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="Open" <?php echo $complaint['status'] == 'Open' ? 'selected' : ''; ?>>Open</option>
            <option value="Closed" <?php echo $complaint['status'] == 'Closed' ? 'selected' : ''; ?>>Closed</option>
        </select>
    </div>
    <button type="submit" class="btn-primary">Update Complaint</button>
</form>

<?php if (!empty($response)): ?>
    <div class="alert alert-<?php echo $response['httpcode'] == 200 ? 'success' : 'danger'; ?>">
        <?php echo $response['response']['message'] ?? 'Complaint updated successfully!'; ?>
    </div>
<?php endif; ?>

<?php include('templates/footer.php'); ?>
