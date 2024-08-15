<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "rentlab-enquiry";

//  initializing variables
$fullname = $email = $phone = $roomNum = $propType = $propArea = $floorArea = $roomNum = $budget = $furnishCond = $tenurePeriod = $moveInDate = $propUse = '';

// Validating Request Method
if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(
        isset($_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['property_type'], $_POST['area'], $_POST['floor_area'],
        $_POST['room-number'], $_POST['budget'], $_POST['furnishing_condition'], $_POST['tenure-period'], $_POST['tenure-indicator'],
        $_POST['move-in-date'], $_POST['property-usage'])
    ){
        // Calling the function for sanitizing and validating user input
        $sanitizedName =  sanitizeInput($_POST['fullname']);
        $validatedEmail = validateEmail($_POST['email']);
        $validatedPhoneNum = validatePhoneNum($_POST['phone']);
        $validatedPropType = validatePropType($_POST['property_type']);
        $validatedFloorArea = validateFloorArea($_POST['floor_area']);
        $validatedRoomNum = validateIntInput($_POST['room-number']);
        $validatedBudget = validateIntInput($_POST['budget']);
        $validatedTenurePeriod = validateIntInput($_POST['tenure-period']);
        $validatedFurnishCondition = validateFurnishCondition($_POST['furnishing_condition']);
        $validatedTenureIndicator = validateTenureIndicator($_POST['tenure-indicator']);
        $validatedMoveInDate = validateDate($_POST['move-in-date']);
        $sanitizedArea =  sanitizeInput($_POST['area']);
        $sanitizedPropUsage =  sanitizeInput($_POST['property-usage']);

        $fullname = $sanitizedName;
        $email = $validatedEmail;
        $phone = $validatedPhoneNum;
        $propType = $validatedPropType;
        $propArea = $sanitizedArea;
        $floorArea = $validatedFloorArea;
        $roomNum = $validatedRoomNum;
        $budget = $validatedBudget;
        $furnishCond = $validatedFurnishCondition;
        $duration = $validatedTenurePeriod;
        $indicator = $validatedTenureIndicator;
        $tenurePeriod = $duration . ' ' . $indicator;
        $moveInDate = $validatedMoveInDate;
        $propUse = $sanitizedPropUsage;

        $conn = new mysqli($servername, $username, $password, $dbname);

        //  establishing connection with the database
        if ($conn->connect_error) {
            die("Connection Failed: " . $conn->connect_error);
        }

        // Submitting query into the database
        $stmt = $conn->prepare("INSERT INTO tenantEnquiry (fullname, email, phoneNum, propType, propArea, floorArea, furnishCond, bedroomNum, moveInDate, tenurePeriod, propUse, budget) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssisssi", $fullname, $email, $phone, $propType, $propArea, $floorArea, $furnishCond, $roomNum, $moveInDate, $tenurePeriod, $propUse, $budget);

        if ($stmt->execute()) {
            header("Location: index.php?success=Enquiry Submitted.");
        } else {
            redirectingError("Error while executing query..");
        }
        
        $stmt->close();
        $conn->close();

    } else {
        redirectingError("One or more required fields are missing.");
    }

    exit();

}
else{
    redirectingError("Invalid input detected..");
}

// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //

// Error Handling Function
function redirectingError($errorMessage)
{

    $queryString = http_build_query([
        'error' => $errorMessage,
        'fullname' => $_POST['fullname'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'area' => $_POST['area'] ?? '',
        'room-number' => $_POST['room-number'] ?? '',
        'budget' => $_POST['budget'] ?? '',
        'tenure-period' => $_POST['tenure-period'] ?? '',
        'property-usage' => $_POST['property-usage'] ?? ''
    ]);

    header("Location: enquiryform.php?$queryString");
    exit();
}


// Functions for sanitizing and validating user input

function sanitizeInput($input){
    $sanitizedInput = preg_replace("/[^a-zA-Z\s]/", "", $input);
    return $sanitizedInput;
}

function validateEmail($input){
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        return $input;  // Valid email
    } else {
        redirectingError("Invalid Email..");
    }
}

function validatePhoneNum($input){
    $pattern = "/^(?:\+?60|0)[1-9]\d{7,9}$/";
    // Validate the phone number
    if (preg_match($pattern, $input)) {
        return $input;  
    } else {
        redirectingError("Invalid Phone Number..");
    }
}

function validatePropType($input){
    if($input === "Residential" || $input === "Commercial" || $input === "Landed" || $input === "Room" ){
        return $input;
    }
    else{
        redirectingError("Invalid Property Type..");
    }
}

function validateFloorArea($input){
    if ($input === "Below 1000" ||
    $input === "1001 - 2000" ||
    $input === "2001 - 3000" ||
    $input === "3001 - 5000" ||
    $input === "5001 - 7000" ||
    $input === "7001 - 10,0000" ||
    $input === "10,001 & above" ||
    $input === "25,000 & above"){
        return $input;
    }
    else{
        redirectingError("Invalid Floor Area..");
    }
}

function validateIntInput($input){
    if(is_numeric($input)){
        return $input;
    }
    else{
        redirectingError("Invalid Integer Input..");
    }
}

function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    // Check if the date matches the format and is a valid date
    if ($d && $d->format($format) === $date) {
        return $date; 
    } else {
        redirectingError("Invalid Date..");
    }
}

function validateTenureIndicator($input){
    if($input === "month(s)" || $input === "year(s)"){
        return $input;
    }
    else{
        redirectingError("Invalid Tenure Indicator..");
    }
}

function validateFurnishCondition($input){
    if($input === "Furnished" || $input === "Semi-furnished" || $input === "Unfurnished"){
        return $input;
    }
    else{
        redirectingError("Invalid Furnishing Condition..");
    }
}