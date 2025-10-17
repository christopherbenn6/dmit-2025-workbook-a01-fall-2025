<?php

// Require is include, with the exception that if the file is not found, PHP will throw an error and die().
// This means if it cant validate, it wont submit the data
require '../private/validation-functions.php';
require '../private/process-form.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evil Corp.&trade; Henchman Application</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Js for range slider -->
    <script src="js/main.js" defer></script>
</head>

<body class="bg-black container px-3 py-5">
    <main class="row justify-center align-items-center min-vh-100">
        <section class="col-md-10 border border-secondary rounded bg-dark text-light p-5">
            <h1 class="fw-light">Evil Corp.&trade; Henchman Application</h1>
            <p class="lead">Welcome to Evil Corp.&trade; where dastardly dreams meet career opportunites!</p>
            <p class="mb-5">We understand that being a henchperson is more than just a job. It's a calling. Whether you're a master at mischief, a pro at pressing big red buttons, or just someone who just wants to look cool guarding a secret lair, we want you on our team.</p>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <section class="my-5">
                    <h2 class="fw-light">Account Creation</h2>
                    <p>All updates on your application status will be available through your exclusive Evil Portal&reg;</p>

                    <!-- Text Inout (Name) -->
                    <div class="mb-4">
                        <!-- If There's an error message, we'll display it right by the input the use needs to fix -->
                        <?php if ($message_name != '') echo $message_name; ?>
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" placeholder="Robin Banks" value="<?= $name; ?>" class="form-control">
                        <p class="form-text text-light">Enter your full name as it appears on your evil henchperson license or birth certificate. Psudonyms (e.g., "The Crusher", "Brutal Brutus", or "Dave") can be added later</p>
                    </div>

                    <!-- Email Input -->
                    <div class="mb-4">
                        <!-- If There's an error message, we'll display it right by the input the use needs to fix -->
                        <?php if ($message_email != '') echo $message_email; ?>
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="example@evilcorp.com" value="<?= $email; ?>" class="form-control">
                        <p class="form-text text-light">Enter a valid email address that you check frequently - evil plans wait for no one.</p>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-4">
                        <!-- If There's an error message, we'll display it right by the input the use needs to fix -->
                        <?php if ($message_phone != '') echo $message_phone; ?>
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="phone" name="phone" id="phone" placeholder="780-123-4567" value="<?= $phone; ?>" class="form-control">
                        <p class="form-text text-light">Provide a valid phone number where we can reach you. Carrier pigeons are no longer accepted after the lawsuit.</p>
                    </div>

                    <!-- Date (DOB) -->
                    <div class="mb-4">
                        <!-- If There's an error message, we'll display it right by the input the use needs to fix -->
                        <?php if ($dob != '') echo $dob; ?>
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" name="dob" id="dob" value="<?= $dob; ?>" class="form-control">
                        <p class="form-text text-light">Enter your date of birth. This shelps us confirm you're old enough for hazardous henching</p>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-4">
                        <!-- If There's an error message, we'll display it right by the input the use needs to fix -->
                        <?php if ($password != '') echo $password; ?>
                        <label for="" class="form-label">Password</label>
                        <input type="text" name="password" id="password" value="<?= $password; ?>" class="form-control">
                        <p class="form-text text-light">Choose a strong password, with:</p>
                        <ul class="form-text text-light">
                            <li>A minimum of 8 characters</li>
                            <li>At least one uppercase letter</li>
                            <li>At least one lowercase letter</li>
                            <li>At least one number</li>
                            <li>One of the following characters: !@#$%^&*<< /li>
                        </ul>
                        <p class="form-text text-light">Avoid using easy to guess passwords, like "password123" or "evil4life"</p>
                    </div>

                    <!-- Password Check -->
                    <div class="mb-4">
                        <!-- If There's an error message, we'll display it right by the input the use needs to fix -->
                        <?php if ($message_password_check != '') echo $message_password_check; ?>
                        <label for="password-check" class="form-label">Secret Password (Again)</label>
                        <input type="text" name="password-check" id="password-check" value="<?= $password_check; ?>" class="form-control">
                        <p class="form-text text-light">Re-enter your password to confirm. Even the most diabolical minds make typos sometimes</p>
                    </div>

                </section>
                <section class="my-5">
                    <h2 class="fw-light">Qualifications</h2>

                    <!-- Number Input (Years of Experience) -->
                    <div class="mb-4">
                        <!-- If There's an error message, we'll display it right by the input the use needs to fix -->
                        <?php if ($message_experience != '') echo $message_experience; ?>
                        <label for="experience" class="form-label">Experience</label>
                        <input type="number" name="experience" id="experience" value="<?= $message_experience; ?>" class="form-control">
                        <p class="form-text text-light">Round to the nearest whole number between 0 and 60</p>
                    </div>

                    <!-- Datalist (Regional Placement) -->
                    <!-- A datalist is a great form control when we want to provide suggestions for the user without limiting their input. It behaves like a combination of a text field and a dropdown menu: users can either choose from a list of suggested values or type in something completely custom.

                    Because users can submit (not just values from the list) we should still validate their input the same way we would for a regular text field input. -->
                    <div class="mb-4">
                        <?php if ($message_region != '') echo $message_region; ?>
                        <label for="region" class="form-label">Preferred global region for assignments:</label>
                        <input list="region-options" id="region" name="region" class="form-control" value="<?= $region ?? ''; ?>">

                        <datalist id="region-options">
                            <option value="Subterranean Bunkers (Europe)"></option>
                            <option value="Volcano Islands (Pacific)"></option>
                            <option value="Abandoned Arctic Labs"></option>
                            <option value="Urban Roofscapes (Night Only)"></option>
                            <option value="Anywhere with Excellent Wi-Fi"></option>
                        </datalist>
                    </div>


                    <!-- Radio Buttons (Department) -->
                    <fieldset class="mb-4">
                        <legend class="fs-5">Which department are you applying for?</legend>
                        <?php if ($message_department != '') echo $message_department; ?>
                        <div class="form-check">
                            <input type="radio" id="traps" name="department" value="traps" <?php if ($department != '' && $department == "traps") echo "checked"; ?> class="form-check-label">
                            <label for="traps" class="form-check-label">Trap-Setting</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="doomsday" name="department" value="doomsday" <?php if ($department != '' && $department == "doomsday") echo "checked"; ?> class="form-check-label">
                            <label for="doomsday" class="form-check-label">Doomsday Device Maintinence</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="monologue" name="department" value="monologue" <?php if ($department != '' && $department == "monologue") echo "checked"; ?> class="form-check-label">
                            <label for="monologue" class="form-check-label">Hero Monologue Intrusion</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="it" name="department" value="it" <?php if ($department != '' && $department == "it") echo "checked"; ?> class="form-check-label">
                            <label for="it" class="form-check-label">IT Help Desk</label>
                        </div>
                    </fieldset>

                    <!-- Checkboxes (Training) -->
                    <fieldset class="mb-4">
                        <legend class="fs-5">Occupational Hazard Training (Optional)</legend>
                        <p>Which of the following occupational hazard training courses have you completed</p>

                        <div class="form-check">
                            <input type="checkbox" id="lava" name="training[]" value="lava" class="form-check-input" <?php if(!empty($training) && in_array("lava", $training)) echo "checked"; ?>>
                            <label for="lava" class="form-check-label">Open Lava Pits and You</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="sharks" name="training[]" value="sharks" class="form-check-input" <?php if(!empty($training) && in_array("sharks", $training)) echo "checked"; ?>>
                            <label for="sharks" class="form-check-label">Shark Tank Etiquette</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="lifting" name="training[]" value="lifting" class="form-check-input" <?php if(!empty($training) && in_array("lifting", $training)) echo "checked"; ?>>
                            <label for="lifting" class="form-check-label">Advanced Hench-Lifting Techniques</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="buttons" name="training[]" value="buttons" class="form-check-input" <?php if(!empty($training) && in_array("buttons", $training)) echo "checked"; ?>>
                            <label for="buttons" class="form-check-label">The Art of Not Touching Big Red Buttons</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="hostages" name="training[]" value="hostages" class="form-check-input" <?php if(!empty($training) && in_array("hostages", $training)) echo "checked"; ?>>
                            <label for="hostages" class="form-check-label">Hostage Handling: Dos and Don'ts</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="evacuation" name="training[]" value="evacuation" class="form-check-input" <?php if(!empty($training) && in_array("evacuation", $training)) echo "checked"; ?>>
                            <label for="evacuation" class="form-check-label">Collapsing Lair Evacuation Procedures</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="retention" name="training[]" value="retention" class="form-check-input" <?php if(!empty($training) && in_array("retention", $training)) echo "checked"; ?>>
                            <label for="retention" class="form-check-label">Employee Retention: Surviving the Villain's Wrath</label>
                        </div>
                    </fieldset>

                    <!-- Range Slider (Loyalty Level) -->
                    <fieldset class="mb-4">
                        <legend class="fs-5">Loyalty to Evil Overlord</legend>
                        <?php if ($message_loyalty != '') echo $message_loyalty; ?>
                        <label for="loyalty" class="form-label">On a scale from 0 to 10, how loyal are you to the current Evil Overlord?</label>
                        <input type="range" id="loyalty" name="loyalty" min="0" max="10" step="1" value="<?= $loyalty ?>" class="form-range" aria-describedby="loyalty-value">

                        <!-- This will let the user know what number they are choosing. It will be dynamically updated by JS or by php when we refresh the page -->
                         <p id="loyalty-value" class="form-text text-light">
                            <span><?php echo isset($_POST['loyalty']) ? $_POST['loyalty'] : 5; ?></span>
                         </p>
                    </fieldset>

                    <!-- Dropdown (Referral) -->
                    <div class="mb-4">
                        <?php if($message_referral != '') echo $message_referral; ?>
                        <label for="referral" class="form-label">How did you hear about us?</label>
                        <select name="referral" id="referral" class="form-select">
                            <option value="">-- Please Select --</option>
                            <option <?php if ($referral != '' && $referral == "classified-ad") echo "selected"; ?> value="classified-ad">Craigslist (Evil Jobs Section)</option>
                            <option <?php if ($referral != '' && $referral == "social-media") echo "selected"; ?> value="social-media">Lava Pit Showcase on TikTok</option>
                            <option <?php if ($referral != '' && $referral == "word-of-mouth") echo "selected"; ?> value="word-of-mouth">Referral from Current Henchperson</option>
                            <option <?php if ($referral != '' && $referral == "mixer") echo "selected"; ?> value="mixer">Villain Networking Mixer</option>
                            <option <?php if ($referral != '' && $referral == "kidnapping") echo "selected"; ?> value="kidnapping">Kidnapped By Your Recruitment Team</option>
                            <option <?php if ($referral != '' && $referral == "family-tradition") echo "selected"; ?> value="family-tradition">Family Tradition</option>
                            <option <?php if ($referral != '' && $referral == "announcement") echo "selected"; ?> value="announcement">Villain's Death Ray Announcement</option>
                        </select>
                    </div>
                </section>
                <section class="my-5">
                    <h2 class="fw-light">Long Answer Questions</h2>
                    <p>At Evil Corp.&trade; we're not just evil-doers - we're evil dreamers, too.</p>

                    <!-- Textarea -->
                    <div class="mb-4">
                        <label for="evil-plan" class="form-label">In 255 characters or fewer, describe your most diabolical plan to date:</label>
                        <textarea name="evil-plan" id="evil-plan" placeholder="YOU'RE GONNA BE MY NEW MEAT BICYCLE" class="form-control"><?= $evil_plan ?></textarea>
                    </div>
                </section>

                <!-- Submission -->
                <div class="my-5">
                    <input type="submit" id="submit" name="submit" value="Create Account &amp; Apply" class="btn btn-warning">
                </div>

                <p class="form-text text-light">Evil Corp&trade; prides itself on being an equal opportunity employer. All goons, mooks, minions, lackeys, grunts, and flunkies are encouraged to apply. Remember: just because we're evil doesn't mean we can't be equal</p>
            </form>
        </section>
    </main>
</body>

</html>