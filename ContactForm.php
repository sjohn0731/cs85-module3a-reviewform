<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
</head>
<body>
    <?php
    function validateInput($data, $fieldName) {
        global $errorCount;
        if (empty($data)) {
            echo "\"$fieldName\" is a required field.<br />\n";
            ++$errorCount;
            $retval = "";
        }
        else { //Only clean up the input if it isn't empty
            $retval = trim($data);
            $retval = stripslashes($retval);
        }

        return($retval);
            /*
            From what I can tell, the validateInput() function:
            -takes in the $data and $fieldName parameters
            -creates the global variable $errorCount
            -if statement that checks the input field and throws an error message if there is no 
                data to interact with and iterates through each input field
            -else statement that "cleans up" any data for security/humans to read and understand
                by using the trim() function to eliminate any excess whitespace and the stripslashes() function
                to eliminate and backslashes and place it in the $retval variable
            */
    }

    function validateEmail($data, $fieldName) {
        global $errorCount;

        if (empty($data)) {
            echo "\"$fieldName\" is a required field.<br />\n";
            ++$errorCount; $retval = "";
        }
        else {
            $retval = filter_var($data, FILTER_SANITIZE_EMAIL);

            if (!filter_var($retval, FILTER_VALIDATE_EMAIL)) {
                echo "\"$fieldName\" is not a valid e-mail address.<br />\n";
            }
        }
    return($retval);
    /*
    The function validateEmail() is very similar to validateInput() where it checks the input field for email and will:
        -throw an error messeage if there is no input data
        -nest an if statement in the else statement that, once the Email input field has data:
            -the filter_var() function checks to see if the input field has a valid email and the FILTER_SANITIZE_EMAIL() function
            will eliminate any illegal characters that aren't part of a valid email address (to avoid XSS)
            -If the data ISN'T a valid email via the filter_var() function, an error message demanding a valid email address pops up
        -End result is returned in the $retval variable at the end of the function

    */
    }

    /*
    
    */



    /*
    REFLECTION:

    */
    ?>
</body>
</html>