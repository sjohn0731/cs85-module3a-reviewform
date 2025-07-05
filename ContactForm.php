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

    /*
    
    */



    /*
    REFLECTION:

    */
    ?>
</body>
</html>