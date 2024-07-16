<?php
    $EID = $_POST['id'];
    
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "rentlab-enquiry";

    $conn = new mysqli($servername,$username,$password,$dbname);

    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM tenantEnquiry WHERE id = ?");
    $stmt->bind_param("i", $EID); // "i" denotes that the parameter is an integer
    $stmt->execute();
    $result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Inquiry Form</title>
    <link rel="stylesheet" href="selectedproperties.css">
</head>
<body>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo">
                Rentlab
            </div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Ecosystem</a></li>
                <li><a href="#">Resources</a></li>
                <li><a href="#">Contact</a></li>
                <li class="selected"><a href="#">Tenant's Enquiry</a></li>
                <li><a href="#"><img src="assets/sample-pp5.jpg" alt="profile_picture"></a></li>
            </ul>
        </div>
    </nav>
    <div class="property-window">
        <a class="back-nav" href="index.php">< Back</a>
        <header style="margin-top: 30px;">
            <div class="selected-inquiry">
                <div class="inquiry_post">
                    <div class="title">Tenant's Enquiry</div>
                    <div class="title_metadata">
                        <?php
                        while($row = $result->fetch_assoc()) {
                        ?>
                        <span>Property type:</span> <?php echo htmlspecialchars($row['propType']); ?> <br>
                        <span>Area:</span> <?php echo htmlspecialchars($row['propArea']); ?> <br>
                        <span>Floor Area:</span> <?php echo htmlspecialchars($row['floorArea']); ?> <br>
                        <span>Furnishing Condition:</span> <?php echo htmlspecialchars($row['furnishCond']); ?> <br>
                        <span>Min. No of bedrooms:</span> <?php echo htmlspecialchars($row['bedroomNum']); ?><br>
                        <span>Move-in Date</span> <?php echo htmlspecialchars($row['moveInDate']); ?> <br>
                        <span>Tenure Period:</span> <?php echo htmlspecialchars($row['tenurePeriod']); ?> <br>
                        <span>Property Usage:</span> <?php echo htmlspecialchars($row['propUse']); ?> <br>
                        <span>Budget:</span> <?php echo htmlspecialchars($row['budget']); ?> <br>
                        <span>Date added:</span> <?php echo htmlspecialchars($row['dateAdded']); ?>
                        <?php
                            }
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
            <div class="head-text">My Property</div>
        </header>
        <table>
            <tr>
                <th>Photo</th>
                <th>Property Info</th>
                <th>Added On</th>
                <th>Bidding Status</th>
                <th>Min Asking Rent</th>
                <th>Action</th>
            </tr>
            <tr align="center">
                <td>
                    <img src="assets/sample-property1.jpg" alt="sample-property1">
                </td>
                <td>
                    <div class="property-title">TItle title @ title ...</div>
                    <div class="property-desc">3 rooms, 2 bathroom unit for...</div>
                </td>
                <td>
                    04/06/2020
                </td>
                <td>
                    2024-06-12<br>15:52:00
                </td>
                <td>
                    RM 1,800.00
                </td>
                <td><button class="action-submit">Submit</button></td>
            </tr>
            <tr align="center">
                <td>
                    <img src="assets/sample-property2.jpg" alt="sample-property1">
                </td>
                <td>
                    <div class="property-title">TItle title @ title ...</div>
                    <div class="property-desc">3 rooms, 2 bathroom unit for...</div>
                </td>
                <td>
                    04/06/2020
                </td>
                <td>
                    2024-06-12<br>15:52:00
                </td>
                <td>
                    RM 1,800.00
                </td>
                <td><button class="action-submit">Submit</button></td>
            </tr>
            <tr align="center">
                <td>
                    <img src="assets/sample-property3.jpg" alt="sample-property1">
                </td>
                <td>
                    <div class="property-title">TItle title @ title ...</div>
                    <div class="property-desc">3 rooms, 2 bathroom unit for...</div>
                </td>
                <td>
                    04/06/2020
                </td>
                <td>
                    2024-06-12<br>15:52:00
                </td>
                <td>
                    RM 1,800.00
                </td>
                <td><button class="action-submit">Submit</button></td>
            </tr>
        </table>
    </div>
</body>
</html>
