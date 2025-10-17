<?php
// Account Creation
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password_check = isset($_POST['password-check']) ? $_POST['password-check'] : '';

// Qualifications
$experience = isset($_POST['experience']) ? trim($_POST['experience']) : '';
$region = isset($_POST['region']) ? $_POST['region'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';
$training = isset($_POST['training']) ? $_POST['training'] : []; //this is a field of checkboxes, so default to array
$loyalty = isset($_POST['loyalty']) ? trim($_POST['loyalty']) : 5;
$referral = isset($_POST['referral']) ? trim($_POST['referral']) : '';

// Long Answer
$evil_plan = isset($_POST['evil_plan']) ? trim($_POST['evil_plan']) : '';

// Error Messages
$message_name = "";
$message_email = "";
$message_phone = "";
$message_password = "";
$message_password_check = "";
$message_dob = "";

$message_experience = "";
$message_region = "";
$message_department = "";
$message_training = "";
$message_loyalty = "";
$message_referral = "";

$message_evil_plan = "";

// Test BOOL
$form_good = isset($_POST['submit']) ? TRUE : FALSE;

// If the user hits submit we will begin our tests
if (isset($_POST['submit'])) {
    /**
     * VALIDATION FOR FULL NAME
     *  
     * Generally we should always start validation with a presence check.
     * For full name we will also make sure that the user gave us letters and that there's a space somewhere in there
     * */ 
    if(is_blank($name)) {
        $message_name = "<p class=\"text-warning\">Please Enter your Name.</p>";
    } elseif (!is_letters($name)){
        $message_name = "<p class=\"text-warning\">Your name can only contain letters and spaces.<p>";
    } elseif (no_spaces($name)) {
        $message_name = "<p class=\"text-warning\">Please enter both your first and last name<p>";
    } elseif ($name == FALSE) {
        $message_name = "<p class=\"text-warning\">Please enter a valid name<p>";
    }

    if($message_name != "") {
        $form_good = FALSE;
    }

    /**
     * VALIDATION FOR EMAIL
     */
    if(is_blank($email)) {
        $message_email = "<p class=\"text-warning\">Please Enter your email address</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message_email = "<p class=\"text-warning\">Please Enter a valid email address</p>";
    }

    if($message_email != "") {
        $form_good = FALSE;
    }

    /**
     * VALIDATION FOR PHONE NUMBERS
     */
    $phone = valid_phone_format($phone);
    if(is_blank($phone)) {
        $message_phone = "<p class=\"text-warning\">Please Enter your phone number</p>"; 
    } elseif (!is_numeric($phone)) {
        $message_phone = "<p class=\"text-warning\">Please Enter a valid phone number</p>"; 
    } elseif(!filter_var($phone, FILTER_VALIDATE_INT)) {
        $message_phone = "<p class=\"text-warning\">Please Enter a valid phone numberrrr</p>"; 
    } elseif (!has_length_exactly($phone, 10)) {
        $message_phone = "<p class=\"text-warning\">Please Enter a 10 digit phone number</p>"; 
    }

    if($message_phone != "") {
        $form_good = FALSE;
    }

    /** 
     * VALIDATION FOR DATES & DATE OF BIRTH
     * 
     * We can check to see if a value is a valid date by creating a DateTime object from it. This is because it ensures the date is both: 
     * 1. properly formatted (matched Y-m-d)
     * 2. A valid calendar date (e.g., it prevents 2025-02-30 from being accepted)
     * 
     * While strtotime() can convert a string into a timestamp, it silently fixes invalid dates instead of rejecting them.
     */
    if(!empty($dob)) {
        // If what the user gave us wasn't empty we will attempt to create a DateTime object from it
        $dob_object = DateTime::createFromFormat('Y-m-d', $dob);

        // We'll check to see if we were able to create the DateTime. and that the resulting object (if any) follows the provided format
        if($dob_object && $dob_object->format('Y-m-d') === $dob) {
            // If the date is valid we will check the user's age by comparing todays date and time to their birthday.
            $today = new DateTime();
            $minimum_age = (clone $today)->modify('-18 years');
            if($dob_object > $minimum_age) {
                $message_dob = "<p class=\"text-warning\">You must be at least 18 years old to apply</p>";
            }

        } else {
            $message_dob = "<p class=\"text-warning\">Please enter a valid date</p>";
        }
    } else {
        $message_dob = "<p class=\"text-warning\">Your date of birth is required</p>";
    }

    if($message_dob != "") {
        $form_good = FALSE;
    }

    /**
     * VALIDATION FOR PASSWORD
     * 
     * IF we tell the user that we want certain things within a password, we should compare theire input with a suitable RegEx.
     * 
     * We could check all of our conditions with a mostrously long regular expression, but if we do it piece-by-piece, we can give more explicit feedback on what theyre missing.
     */
    if(is_blank($password)) {
        $message_password = "<p class=\"text-warning\">Please enter a password</p>"; 
    } elseif (strlen($password) < 8) {
        $message_password = "<p class=\"text-warning\">Your password must be at least 8 characters long</p>"; 
    } elseif(!preg_match('/[A-Z]/', $password)) {
        $message_password = "<p class=\"text-warning\">Your password must include a capital letter</p>";
    } elseif(!preg_match('/[a-z]/', $password)) {
        $message_password = "<p class=\"text-warning\">Your password must include a lowercase letter</p>";
    } elseif(!preg_match('/[0-9]/', $password)) {
       $message_password = "<p class=\"text-warning\">Your password must include a number</p>";
    } elseif(!preg_match('/[\W_]/', $password)) {
        $message_password = "<p class=\"text-warning\">Your password must include one of the following special characters !@#$%^&*()</p>";
    }

    if($message_password != "") {
        $form_good = FALSE;
    }

    /**
     * VALIDATION FOR PASSWORD COMPARISON
     */
    if($password != $password_check) {
        $message_password_check = "<p class=\"text-warning\">Your passwords do not match</p>"; 
        $form_good = FALSE;
    }

    /**
     * NUMBERS
     * 
     * For this field we want to make sure 
     * 1. It's a number
     * 2. It's a whole number
     * 3. It's within a reasonable range (0-60)
     */
    if($experience == "") {
        $message_experience = "<p class=\"text-warning\">This field is required, please enter a whole number (even if it is 0)</p>";
    } elseif (!is_numeric($experience)) {
        $message_experience = "<p class=\"text-warning\">Please enter a number</p>";
    } elseif (!ctype_digit($experience)) { //ctype_digit is a stricter isnumeric (isnumeric allows syntax)
        $message_experience = "<p class=\"text-warning\">Please enter a whole number</p>";
    } elseif ($experience < 0 || $experience > 60) {
        $message_experience = "<p class=\"text-warning\">Experience must be between 0 and 60 years</p>";
    }

    if($message_experience != "") {
        $form_good = FALSE;
    }

    /**\
     * DATA LISTS
     */
    if(!is_blank($region)) {
        if(strlen($region) > 128) {
            $message_region = "<p class=\"text-warning\">Your response must be 128 characters or less</p>";
        } elseif (!preg_match("/^[a-zA-Z0-9 .,'()&\-\/]+$/", $region)) {
            $message_region = "<p class=\"text-warning\">Region Name contains invalid Characters</p>";
        }
    } // else leave alone (optional)

    if($message_region != "") {
        $form_good = FALSE;
    }

    /**
     * Radio Buttons
     * 
     * Presence Check -> see if it is allowed value (only 4 values) -> 
     */

    $valid_departments = ['traps', 'doomsday', 'monologue', 'it'];

    if(is_blank($department)) {
        $message_department = "<p class=\"text-warning\">Please select a department</p>";
    } elseif (!in_array($department, $valid_departments)) {
        $message_department = "<p class=\"text-warning\">Invalid department, please choose a provided option</p>";
    }

    if($message_department != "") {
        $form_good = FALSE;
    }

    /**
     * Checkboxes
     * 
     * Checkboxes work like radios, but multiple values may be submitted. Therefore when checkboxes are used, we need an array
     * so we loop through each item
     */

    $valid_training = ['lava', 'sharks', 'lifting', 'buttons', 'hostages', 'evacuation', 'retention'];

    if(!empty($training)) {
        foreach($training as $value) {
            if(!in_array($value, $valid_training)) {
                $message_training = "<p class=\"text-warning\">Value is not allowed, please choose a provided option</p>";
                $form_good = FALSE;
                break;
            }
        }
    }


    /**
     * Range Slider
     */

    //These are impossible without dev tools or error with form
    if ($loyalty === "" || !is_numeric($loyalty) || $loyalty < 0 || $loyalty > 10) {
        $message_loyalty = "<p class=\"text-warning\">Invalid loyalty range. Well done, cheater</p>";
    }

    if($message_loyalty != "") {
        $form_good = FALSE;
    }

    /**
     * Dropdown
     */

    $valid_referrals = ['classified-ad', 'social-media', 'word-of-mouth', 'mixer', 'kidnapping', 'family', 'announcement'];

    if($referral === "") {
        $message_referral = "<p class=\"text-warning\">Please select a referral source</p>";
    } elseif (!in_array($referral, $valid_referrals)) {
        $message_referral = "<p class=\"text-warning\">Please choose a provided option</p>";
    }

    if($message_referral != "") {
        $form_good = FALSE;
    }

    /**
     * Long Answer
     */
    if(is_blank($evil_plan)) {
        $message_evil_plan = "<p class=\"text-warning\">Please describe your evil plan</p>";
    } elseif (!filter_var($evil_plan, FILTER_SANITIZE_SPECIAL_CHARS)) {
        //This filter list strips any chars with ascii value below 32, which include things like system I/0
        $message_evil_plan = "<p class=\"text-warning\">How evil of you, too evil in fact. Write another one</p>";
    } elseif (strlen($evil_plan) > 256) {
        $message_evil_plan = "<p class=\"text-warning\">Too many characters</p>";
    }

    if($message_evil_plan != "") {
        $form_good = FALSE;
    }

    // If the user input passes, we give a success message to let them know that everything worked. Given we stay on the same page, We then reset all variables so they cant submit multiple times and know it worked

    if($form_good) {
        // This redirects to thank-you
        header("Location: thank-you.php");
    }
}

?>