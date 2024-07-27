<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Complaint</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Post a New Complaint</h1>
    <form action="post_complaint.php" method="POST">
        <label for="mobileNumber">Mobile Number:</label>
        <input type="text" id="mobileNumber" name="mobileNumber" required><br>

        <label for="categoryId">Category ID:</label>
        <input type="text" id="categoryId" name="categoryId" required><br>

        <label for="complaintLatitude">Latitude:</label>
        <input type="text" id="complaintLatitude" name="complaintLatitude" required><br>

        <label for="complaintLongitude">Longitude:</label>
        <input type="text" id="complaintLongitude" name="complaintLongitude" required><br>

        <label for="complaintLocation">Location:</label>
        <input type="text" id="complaintLocation" name="complaintLocation" required><br>

        <label for="complaintLandmark">Landmark:</label>
        <input type="text" id="complaintLandmark" name="complaintLandmark" required><br>

        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required><br>

        <label for="file">Image URL:</label>
        <input type="text" id="file" name="file" required><br>

        <button type="submit" name="submit">Submit Complaint</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $mobileNumber = $_POST['mobileNumber'];
        $categoryId = $_POST['categoryId'];
        $complaintLatitude = $_POST['complaintLatitude'];
        $complaintLongitude = $_POST['complaintLongitude'];
        $complaintLocation = $_POST['complaintLocation'];
        $complaintLandmark = $_POST['complaintLandmark'];
        $fullName = $_POST['fullName'];
        $file = $_POST['file'];

        $url = "http://api.swachh.city/sbm/v1/post-complaint?vendor_name=India&access_key=8a34n9up&mobileNumber=$mobileNumber&categoryId=$categoryId&complaintLatitude=$complaintLatitude&complaintLongitude=$complaintLongitude&complaintLocation=$complaintLocation&complaintLandmark=$complaintLandmark&fullName=$fullName&deviceOs=external&file=$file";

        $response = file_get_contents($url);
        echo "<p>Response: $response</p>";
    }
    ?>
</body>
</html>
