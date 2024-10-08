<?php
// Retrieve the error message and the previous input from the query parameter
$error = isset($_GET['error']) ? $_GET['error'] : '';
$previousData = [
    'fullname' => isset($_GET['fullname']) ? htmlspecialchars($_GET['fullname']) : '',
    'email' => isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '',
    'phone' => isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : '',
    'property_type' => isset($_GET['property_type']) ? htmlspecialchars($_GET['property_type']) : '',
    'area' => isset($_GET['area']) ? htmlspecialchars($_GET['area']) : '',
    'floor_area' => isset($_GET['floor_area']) ? htmlspecialchars($_GET['floor_area']) : '',
    'room-number' => isset($_GET['room-number']) ? htmlspecialchars($_GET['room-number']) : '',
    'budget' => isset($_GET['budget']) ? htmlspecialchars($_GET['budget']) : '',
    'furnishing_condition' => isset($_GET['furnishing_condition']) ? htmlspecialchars($_GET['furnishing_condition']) : '',
    'tenure-period' => isset($_GET['tenure-period']) ? htmlspecialchars($_GET['tenure-period']) : '',
    'tenure-indicator' => isset($_GET['tenure-indicator']) ? htmlspecialchars($_GET['tenure-indicator']) : '',
    'move-in-date' => isset($_GET['move-in-date']) ? htmlspecialchars($_GET['move-in-date']) : '',
    'property-usage' => isset($_GET['property-usage']) ? htmlspecialchars($_GET['property-usage']) : '',
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Inquiry Form</title>
    <link rel="stylesheet" href="enquiryform.css">
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
    <div class="form-container">
        <a class="back-nav" href="index.php">&lt; Back</a>
        <h2>Rental Properties Request</h2>
        <div class="form-desc">Please provide a valid email and contact number to receive property listings that
            match your requirements, submitted by the property owners or real estate agents.
        </div>
        <hr>
        <!-- Form Part 1: Contact Information -->
        <div class="form-page" id="contact-info">
            <form action="submit-enquiry.php" method="POST">
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required value="<?=htmlspecialchars($previousData['fullname'])?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email address" required value="<?=htmlspecialchars($previousData['email'])?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required value="<?=htmlspecialchars($previousData['phone'])?>">
                </div>
                <div class="form-group">
                    <label for="property-type">Property Type</label>
                    <select id="property-type" name="property_type" required>
                        <option value="" disabled selected>Select property type</option>
                        <option value="Residential">Residential</option>
                        <option value="Commercial">Commercial</option>
                        <option value="Landed">Landed</option>
                        <option value="Room">Room</option>
                    </select>
                </div>
                <div class="form-group" style="display: flex; flex-direction: column;">
                    <label for="area">Property / Area / Location</label>
                    <input type="text" id="area" name="area" placeholder="Enter the preferred property/project name, area or location" required value="<?=htmlspecialchars($previousData['area'])?>">
                </div>
                <div class="form-group">
                    <label>Size (sq ft)</label>
                    <div class="radio-group">
                        <label><input type="radio" name="floor_area" value="Below 1000" required>Below 1000</label>
                        <label><input type="radio" name="floor_area" value="1001 - 2000" required>1001 - 2000</label>
                        <label><input type="radio" name="floor_area" value="2001 - 3000" required>2001 - 3000</label>
                        <label><input type="radio" name="floor_area" value="3001 - 5000" required>3001 - 5000</label>
                        <label><input type="radio" name="floor_area" value="5001 - 7000" required>5001 - 7000</label>
                        <label><input type="radio" name="floor_area" value="7001 - 10,0000" required>7001 - 10,0000</label>
                        <label><input type="radio" name="floor_area" value="10,001 & above" required>10,001 & above</label>
                        <label><input type="radio" name="floor_area" value="25,000 & above" required>25,000 & above</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="room-number">Min. number of Bedrooms</label>
                    <input type="number" id="room-number" name="room-number" placeholder="Enter your Minimum Number of Bedrooms" required min="0" value="<?=htmlspecialchars($previousData['room-number'])?>">
                </div>
                <div class="form-group">
                    <label for="budget">Budget (RM / Month)</label>
                    <input type="number" id="budget" name="budget" placeholder="Enter your budget" required min="0" value="<?=htmlspecialchars($previousData['budget'])?>">
                </div>
                <div class="form-group">
                    <label for="furnishing-condition">Furnishing Condition</label>
                    <select id="furnishing-condition" name="furnishing_condition" required>
                        <option value="" disabled selected>Select furnishing condition</option>
                        <option value="Furnished">Furnished</option>
                        <option value="Semi-furnished">Semi-Furnished</option>
                        <option value="Unfurnished">Unfurnished</option>
                    </select>
                </div>
                <div class="form-group-tenure">
                    <label for="tenure-period">Tenancy Period</label>
                    <div>
                        <input type="number" id="tenure-period" name="tenure-period" placeholder="Enter the tenure period" required min="0" value="<?= htmlspecialchars($previousData['tenure-period']) ?>">
                        <select id="tenure-indicator" name="tenure-indicator" required>
                            <option value="month(s)">month(s)</option>
                            <option value="year(s)">year(s)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="move-in-date">Expected move-in date</label>
                    <input type="date" id="move-in-date" name="move-in-date" placeholder="Enter your move-in date" required>
                </div>
                <div class="form-group">
                    <label for="property-usage">Property Usage:</label>
                    <input type="text" id="property-usage" name="property-usage" placeholder="Enter the property usage" required value="<?=htmlspecialchars($previousData['property-usage'])?>">
                </div>
                <div class="form-buttons">
                    <button type="submit">Submit</button>
                </div>
            </form>
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
<script>
        // Function to show a popup message if there's an error
        function showError() {
            var error = "<?php echo $error; ?>";
            if (error) {
                alert(error);
            }
        }
        window.onload = showError;
</script>
</html>
