<?php
include('config.php');
include('api/swachhata.php');
include('templates/header.php');

$response = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'postComplaint') {
        $data = [
            'vendor_name' => VENDOR_NAME,
            'access_key' => ACCESS_KEY,
            'mobileNumber' => $_POST['mobileNumber'] ?? '',
            'categoryId' => $_POST['categoryId'] ?? '',
            'complaintLatitude' => $_POST['complaintLatitude'] ?? '',
            'complaintLongitude' => $_POST['complaintLongitude'] ?? '',
            'complaintLocation' => $_POST['complaintLocation'] ?? '',
            'complaintLandmark' => $_POST['complaintLandmark'] ?? '',
            'fullName' => $_POST['fullName'] ?? '',
            'userLatitude' => $_POST['userLatitude'] ?? '',
            'userLongitude' => $_POST['userLongitude'] ?? '',
            'userLocation' => $_POST['userLocation'] ?? '',
            'deviceOs' => 'external',
            'file' => $_POST['file'] ?? ''
        ];
        $response = postComplaint($data);
    }
}

$params = [
    'vendor_name' => VENDOR_NAME,
    'access_key' => ACCESS_KEY,
    'page' => 1,
    'status' => 4,
    'category' => 11,
    'from_date' => '2020-11-09',
    'to_date' => '2021-11-20'
];
$complaints = getComplaints($params);
?>

<h1>Swachhata Complaint Management</h1>

<h2>Post Complaint</h2>
<form method="POST" action="index.php">
    <input type="hidden" name="action" value="postComplaint">
    <div class="form-group">
        <label for="mobileNumber">Mobile Number</label>
        <input type="text" id="mobileNumber" name="mobileNumber" required>
    </div>
    <div class="form-group">
        <label for="categoryId">Category</label>
        <select id="categoryId" name="categoryId" required>
            <option value="1">Dead animal(s)</option>
            <option value="2">Dustbins not cleaned</option>
            <option value="3">Garbage dump</option>
            <option value="4">Garbage vehicle not arrived</option>
            <option value="5">Sweeping not done</option>
            <!-- Add other categories here -->
        </select>
    </div>
    <div class="form-group">
        <label for="complaintLatitude">Complaint Latitude</label>
        <input type="text" id="complaintLatitude" name="complaintLatitude" required readonly>
    </div>
    <div class="form-group">
        <label for="complaintLongitude">Complaint Longitude</label>
        <input type="text" id="complaintLongitude" name="complaintLongitude" required readonly>
    </div>
    <div id="map" style="height: 400px; width: 100%;"></div>
    <div class="form-group">
        <label for="compl
        <label for="complaintLocation">Location</label>
        <input type="text" id="complaintLocation" name="complaintLocation" required>
    </div>
    <div class="form-group">
        <label for="complaintLandmark">Landmark</label>
        <input type="text" id="complaintLandmark" name="complaintLandmark" required>
    </div>
    <div class="form-group">
        <label for="fullName">Full Name</label>
        <input type="text" id="fullName" name="fullName">
    </div>
    <div class="form-group">
        <label for="userLatitude">User Latitude</label>
        <input type="text" id="userLatitude" name="userLatitude" required readonly>
    </div>
    <div class="form-group">
        <label for="userLongitude">User Longitude</label>
        <input type="text" id="userLongitude" name="userLongitude" required readonly>
    </div>
    <div class="form-group">
        <label for="userLocation">User Location</label>
        <input type="text" id="userLocation" name="userLocation" required>
    </div>
    <div id="userMap" style="height: 400px; width: 100%;"></div>
    <div class="form-group">
        <label for="file">Image URL</label>
        <input type="text" id="file" name="file">
    </div>
    <button type="submit" class="btn-primary">Submit Complaint</button>
</form>

<?php if (!empty($response)): ?>
    <div class="alert alert-<?php echo $response['httpcode'] == 200 ? 'success' : 'danger'; ?>">
        <?php echo $response['response']['message'] ?? 'Complaint submitted successfully!'; ?>
    </div>
<?php endif; ?>

<h2 class="mt-5">Complaints List</h2>
<?php if (!empty($complaints['response']['complaints'])): ?>
    <ul class="list-group">
        <?php foreach ($complaints['response']['complaints'] as $complaint): ?>
            <li class="list-group-item">
                <strong><?php echo htmlspecialchars($complaint['title']); ?></strong> - <?php echo htmlspecialchars($complaint['complaintLocation']); ?>
                <a href="view_complaint.php?id=<?php echo $complaint['id']; ?>" class="btn btn-info btn-sm">View</a>
                <a href="update_complaint.php?id=<?php echo $complaint['id']; ?>" class="btn btn-warning btn-sm">Update</a>
                <a href="delete_complaint.php?id=<?php echo $complaint['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this complaint?');">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No complaints found.</p>
<?php endif; ?>

<?php include('templates/footer.php'); ?>
