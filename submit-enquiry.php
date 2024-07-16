<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "rentlab-enquiry";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$fullname = $email = $phone = $propType = $propArea = $floorArea = $roomNum = $budget = $furnishCond = $tenurePeriod = $moveInDate = $propUse = '';

if (
    isset($_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['property_type'], $_POST['area'], $_POST['floor_area'],
    $_POST['room-number'], $_POST['budget'], $_POST['furnishing_condition'], $_POST['tenure-period'], $_POST['tenure-indicator'],
    $_POST['move-in-date'], $_POST['property-usage'])
) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $propType = $_POST['property_type'];
    $propArea = $_POST['area'];
    $floorArea = $_POST['floor_area'];
    $roomNum = $_POST['room-number'];
    $budget = $_POST['budget'];
    $furnishCond = $_POST['furnishing_condition'];
    $duration = $_POST['tenure-period'];
    $indicator = $_POST['tenure-indicator'];
    $tenurePeriod = $duration . ' ' . $indicator;
    $moveInDate = $_POST['move-in-date'];
    $propUse = $_POST['property-usage'];

    $stmt = $conn->prepare("INSERT INTO tenantEnquiry (fullname, email, phoneNum, propType, propArea, floorArea, furnishCond, moveInDate, tenurePeriod, propUse, budget) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssi", $fullname, $email, $phone, $propType, $propArea, $floorArea, $furnishCond, $moveInDate, $tenurePeriod, $propUse, $budget);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: One or more required fields are missing.";
}

$conn->close();
?>