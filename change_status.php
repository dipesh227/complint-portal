<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Complaint Status</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Change Complaint Status</h1>
    <form action="change_status.php" method="POST">
        <label for="mobileNumber">Mobile Number:</label>
        <input type="text" id="mobileNumber" name="mobileNumber" required><br>

        <label for="complaintId">Complaint ID:</label>
        <input type="text" id="complaintId" name="complaint
        <input type="text" id="complaintId" name="complaintId" required><br>

        <label for="status">Status:</label>
        <input type="text" id="status" name="status" required><br>

        <button type="submit" name="submit">Change Status</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $mobileNumber = $_POST['mobileNumber'];
        $complaintId = $_POST['complaintId'];
        $status = $_POST['status'];

        $url = "http://api.swachh.city/sbm/v1/post-complaint-status?vendor_name=India&access_key=8a34n9up&mobileNumber=$mobileNumber&complaintId=$complaintId&status=$status&deviceOs=external";

        $response = file_get_contents($url);
        echo "<p>Response: $response</p>";
    }
    ?>
</body>
</html>
