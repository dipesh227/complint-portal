<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Complaint</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Vote a Complaint</h1>
    <form action="vote_complaint.php" method="POST">
        <label for="mobileNumber">Mobile Number:</label>
        <input type="text" id="mobileNumber" name="mobileNumber" required><br>

        <label for="complaintId">Complaint ID:</label>
        <input type="text" id="complaintId" name="complaintId" required><br>

        <button type="submit" name="submit">Vote Complaint</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $mobileNumber = $_POST['mobileNumber'];
        $complaintId = $_POST['complaintId'];

        $url = "http://api.swachh.city/sbm/v1/post-voteup?vendor_name=India&access_key=8a34n9up&mobileNumber=$mobileNumber&complaintId=$complaintId&deviceOs=external";

        $response = file_get_contents($url);
        echo "<p>Response: $response</p>";
    }
    ?>
</body>
</html>
