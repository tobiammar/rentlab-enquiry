<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "rentlab-enquiry";

    $conn = new mysqli($servername,$username,$password,$dbname);

    if ($conn->connect_error) {
        die("connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id,propType,propArea,floorArea,furnishCond,bedroomNum,moveInDate,tenurePeriod,propUse,budget,dateAdded from tenantEnquiry ORDER BY id DESC";
    $result = $conn->query($sql);

    $enquiryNumber = $result->num_rows;
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo">
                <a href="#"><img src="assets/Rentlab1.png" alt="rentlablogo"></a>
            </div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Ecosystem</a></li>
                <li><a href="#">Resources</a></li>
                <li><a href="#">Contact</a></li>
                <li class="selected"><a href="#">Tenant's Enquiry</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#"><img src="assets/sample-pp5.jpg" alt="profile_picture"></a></li>
            </ul>
        </div>
        <div class="pagetitle">Enquiries</div>
    </nav>
    <div class="howto-section">
            <h1>How Does Tenant's Request Works?</h1>
            <div class="howto-steps">
                <div class="step-box">
                    <img src="assets/step-1.png" alt="question">
                    <h3>Step 1</h3>
                    <div> 
                        <span>You Desired Property</span> 
                        <br>Let us know the requirements for the ideal rental properties that you are looking for
                    </div>
                </div>
                <div class="step-box">
                    <img src="assets/step-2.png" alt="form">
                    <h3>Step 2</h3>
                    <div> 
                        <span>Landlord's Proposals</span> 
                        <br>Landlords & agents submit their properties that meet the requirements listed
                    </div>
                </div>
                <div class="step-box">
                    <img src="assets/step-3.png" alt="">
                    <h3>Step 3</h3>
                    <div> 
                        <span>Tenant Offer & Bid</span>
                        <br> Receive proposed properties. Offer and bid for the property that best meet your requirements.
                    </div>
                </div>
            </div>
    </div>
    <hr>
    <div class="inquiry-title">List of Property Requests</div>
    <div class="main">
        <div class="inquiry_list">
            <span style="font-weight: bold;">Showing <?php echo $enquiryNumber ?> results</span>
            <span><a href="inquiryform.html"> + &nbsp; Add Request</a></span>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="inquiry_post">
                        <div class="title_post">
                            <img src="assets/plain-avatar.png" alt="profile_picture">
                            <div class="title"><?php echo htmlspecialchars($row['propType']); ?> @<br><?php echo htmlspecialchars($row['propArea']); ?></div>
                        </div>
                        <div class="title_metadata">
                            <span>Property type:</span> <?php echo htmlspecialchars($row['propType']); ?><br>
                            <span>Area:</span> <?php echo htmlspecialchars($row['propArea']); ?><br>
                            <span>Floor Area:</span> <?php echo htmlspecialchars($row['floorArea']); ?> <br>
                            <span>Furnishing Condition:</span> <?php echo htmlspecialchars($row['furnishCond']); ?><br>
                            <span>Move-in date:</span> <?php echo htmlspecialchars($row['moveInDate']); ?><br>
                            <span>Tenure Period:</span> <?php echo htmlspecialchars($row['tenurePeriod']); ?><br>
                            <span>Property Usage:</span> <?php echo htmlspecialchars($row['propUse']); ?><br>
                            <div class="budget">
                                Budget: RM<?php echo htmlspecialchars($row['budget']); ?>
                            </div>
                        </div>
                        <div class="date">Added: <span><?php echo htmlspecialchars($row['dateAdded']); ?></span></div>
                        <form action="selectproperties.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <button type="submit">Submit Property</button>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </div>
<footer style="background-color: #282828; color: #ffffff; padding: 40px 0; font-family: Arial, sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
            <div style="flex: 1; min-width: 200px;">
                <h4 style="font-size: 18px; border-bottom: 2px solid #ffffff; padding-bottom: 10px;">Quick Links</h4>
                <ul style="list-style-type: none; padding: 0; line-height: 1.8;">
                    <li><a href="/tutorial-guides" style="color: #ffffff; text-decoration: none;">Tutorial & Guides</a></li>
                    <li><a href="/news-and-events" style="color: #ffffff; text-decoration: none;">News And Events</a></li>
                    <li><a href="/faq" style="color: #ffffff; text-decoration: none;">FAQ</a></li>
                    <li><a href="/careers" style="color: #ffffff; text-decoration: none;">Careers</a></li>
                    <li><a href="/terms-and-conditions" style="color: #ffffff; text-decoration: none;">Terms & Conditions</a></li>
                    <li><a href="/privacy-policy" style="color: #ffffff; text-decoration: none;">Privacy Policy</a></li>
                    <li><a href="/refund-policy" style="color: #ffffff; text-decoration: none;">Refund Policy</a></li>
                </ul>
            </div>
            <div style="flex: 1; min-width: 200px;">
                <h4 style="font-size: 18px; border-bottom: 2px solid #ffffff; padding-bottom: 10px;">Contact Us</h4>
                <address style="line-height: 1.8;">
                    Rentlab Sdn. Bhd.<br>
                    Unit 01-03, 1st Floor, Micasa Shoppes,<br>
                    368-A, Jalan Tun Razak,<br>
                    50400 Kuala Lumpur<br>
                    Email: <a href="mailto:info@rentlab.com.my" style="color: #ffffff; text-decoration: none;">info@rentlab.com.my</a><br>
                    Phone: <a href="tel:+601157300759" style="color: #ffffff; text-decoration: none;">+6011-57300759</a>
                </address>
            </div>
            <div style="flex: 1; min-width: 200px;">
                <h4 style="font-size: 18px; border-bottom: 2px solid #ffffff; padding-bottom: 10px;">Follow Us</h4>
                <div>
                    <a href="#" style="color: #ffffff; margin-right: 10px; text-decoration: none;">Facebook</a>
                    <a href="#" style="color: #ffffff; margin-right: 10px; text-decoration: none;">Twitter</a>
                    <a href="#" style="color: #ffffff; text-decoration: none;">LinkedIn</a>
                </div>
            </div>
        </div>
        <div style="text-align: center; margin-top: 20px; border-top: 1px solid #444444; padding-top: 20px;">
            <p style="margin: 0;">&copy; 2024 Rentlab Sdn Bhd (Co. Reg. No. 201901023324/1332653-U). All rights reserved.</p>
        </div>
    </div>
</footer>

</body>
</html>