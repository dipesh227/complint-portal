<?php
include('config.php');
include('api/swachhata.php');
include('templates/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'postComplaint') {
        $data = [
            'vendor_name' => VENDOR_NAME,
            'access_key' => ACCESS_KEY,
            'mobileNumber' => $_POST['mobileNumber'],
            'categoryId' => $_POST['categoryId'],
            'complaintLatitude' => $_POST['complaintLatitude'],
            'complaintLongitude' => $_POST['complaintLongitude'],
            'complaintLocation' => $_POST['complaintLocation'],
            'complaintLandmark' => $_POST['complaintLandmark'],
            'fullName' => $_POST['fullName'],
            'userLatitude' => $_POST['userLatitude'],
            'userLongitude' => $_POST['userLongitude'],
            'userLocation' => $_POST['userLocation'],
            'deviceOs' => 'external',
            'file' => $_POST['file']
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
        <label for="file">Image URL</label>
        <input type="text" id="file" name="file">
    </div>
    <button type="submit" class="btn-primary">Submit Complaint</button>
</form>

<h2 class="mt-5">Complaints List</h2>
<?php if (!empty($complaints['response']['complaints'])): ?>
    <ul class="list-group">
        <?php foreach ($complaints['response']['complaints'] as $complaint): ?>
            <li class="list-group-item">
                <strong><?php echo $complaint['title']; ?></strong> - <?php echo $complaint['complaintLocation']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No complaints found.</p>
<?php endif; ?>

<?php
include('templates/footer.php');
?>
