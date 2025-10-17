<?php 

    // This file contains a collection of reusable validation helper functions.

    // BLANKS / PRESENSE: Check whether or not a value is set or exists.
    // EXCLUSIONS / INCLUSIONS : Verify that value is among a set of allowed values.
    // DATA TYPE: PHONE NUMBER: Normalize phone inputs by stripping syntax
    // DATA TYPE: STRINGS: Validate string length and character constraints

    /**  Determines if a value is blank after trimming whitespace. It uses === to prevent 0 as blank
     * @param mixed - The value we want to check 
     * @return BOOL - TRUE if the value is not set or is an empty string (after trimming)
    */
    function is_blank($value) {
        return !isset($value) || trim($value) === '';
    }

    /**
     * EXCLUSIONS / INCLUSIONS
     * 
     * Checks if a value exists in a set of allowed values.
     * Useful for validating dropdowns, radio buttons, or any discrete list of values.
     * 
     * @param mixed - The value to test
     * @param array - An array of allowed values
     * @return BOOL - TRUE if $value is found in $set; false otherwise
    */
    function has_allowed_value($value, $set) { 
        return in_array($value, $set);
    }

    /**
     * DATA TYPE: PHONE NUMBER
     * 
     * Normalizes a phone number by stripping common formatting errors
     * Removes: +-.,() and spaces
     * @param string - Raw phone number input
     * @return string - Sanitized numeric phone string
    */
    function valid_phone_format($value) {
        // We want to remove the following: +-.,()
        $value = str_replace("+", "", $value);
        $value = str_replace("-", "", $value);
        $value = str_replace(".", "", $value);
        $value = str_replace(",", "", $value);
        $value = str_replace("(", "", $value);
        $value = str_replace(")", "", $value);

        return $value;
    }
    /**
     * DATA TYPE: STRINGS
    */

    /**
     * Checks if the length of a string is less than a maximum value
     * @param string $value - The string to measure
     * @param int $max - The maximum length allowed
     * @return bool - TRUE if the length of the string is less than the maximum length allowed
     */
    function has_length_less_than ($value, $max) {
        $length = strlen($value);
        return $length < $max;
    }

    /**
     * Determines whether a string contains no space characters
     * 
     * @param string $value - The string to inspect
     * @return bool - TRUE if no spaces are found
     */
    function no_spaces ($value) {
        return strpos($value, " ") == FALSE;
    }

    /**
     * Validates that a string has exactly the specified length
     * @param string $value - The string to check
     * @param int $required_length - The length the string must be
     * @return bool - TRUE if $value is exactly @required_length characters long
     */
    function has_length_exactly ($value, $required_length) {
        return strlen($value) === $required_length;
    }

    /**
     * Validates that a string contains only letters (a-z case insensitive) and spaces
     * 
     * @param string $value - The string to check
     * @return bool - TRUE if $value contains only letters and spaces
     */
    function is_letters ($value) {
        return preg_match("/^[a-zA-Z\s]*$/", $value);
    }
?>